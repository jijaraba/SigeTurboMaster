<?php


namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Events\Stream;
use SigeTurbo\Http\Requests\PurchaseRequest;
use SigeTurbo\Http\Requests\PurchaseStatusRequest;
use SigeTurbo\Mailer\MailerInterface;
use SigeTurbo\Provider;
use SigeTurbo\Purchases\Purchases;
use SigeTurbo\Repositories\Provider\ProviderRepositoryInterface;
use SigeTurbo\Repositories\Purchase\PurchaseRepositoryInterface;
use SigeTurbo\Repositories\Statuspurchase\StatuspurchaseRepositoryInterface;

class PurchasesController extends Controller
{
    /**
     * @var PurchaseRepositoryInterface
     */
    private $purchaseProvider;
    /**
     * @var StatuspurchaseRepositoryInterface
     */
    private $statuspurchaseRepository;
    /**
     * @var ProviderRepositoryInterface
     */
    private $providerRepository;
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @param PurchaseRepositoryInterface $purchaseProvider
     * @param StatuspurchaseRepositoryInterface $statuspurchaseRepository
     * @param ProviderRepositoryInterface $providerRepository
     * @param MailerInterface $mailer
     */
    function __construct(PurchaseRepositoryInterface $purchaseProvider,
                         StatuspurchaseRepositoryInterface $statuspurchaseRepository,
                         ProviderRepositoryInterface $providerRepository,
                         MailerInterface $mailer)
    {

        $this->purchaseProvider = $purchaseProvider;
        $this->statuspurchaseRepository = $statuspurchaseRepository;
        $this->providerRepository = $providerRepository;
        $this->mailer = $mailer;
    }


    /**
     * Display a listing of the resource.
     * GET /purchases
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        //Search
        $search = null;
        if (isset($request['search'])) {
            $search = $request['search'];
        }

        //Provider
        $provider = null;
        if (isset($request['provider'])) {
            $provider = $request['provider'];
        }

        //View
        $view = 'list';
        if (isset($request['view'])) {
            $view = $request['view'];
        }

        //Sort
        $sort = 'code';
        if (isset($request['sort'])) {
            $sort = $request['sort'];
        }

        //Order
        $order = 'desc';
        if (isset($request['order'])) {
            $order = $request['order'];
        }

        //Page
        if (!isset($request['page'])) {
            $request['page'] = 1;
        }

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;
        $purchases =  $this->purchaseProvider->all($sort, strtoupper($order), $provider);
        $paginator = new LengthAwarePaginator(
            $purchases->forPage($page, $perPage), $purchases->count(), $perPage, $page
        );
        $paginator->setPath('resources/purchases');
        return view('purchases.index')
            ->withPurchases($paginator)
            ->withSearch($search)
            ->withView($view)
            ->withSort($sort)
            ->withOrder($order);
    }

    /**
     * Create Purchase
     * @return Response
     */
    public function create(){
        return view('purchases.create')
            ->withStatuses($this->statuspurchaseRepository->all()->lists('name', 'idstatuspurchase'))
            ->withProviders($this->providerRepository->all()->lists('name','idprovider'));
    }

    /**
     * Store a newly created resource in storage.
     * @param PurchaseRequest $request
     * @return Response
     */
    public function store(PurchaseRequest $request)
    {
        $date = date("Y-m-d");
        $code = $this->purchaseProvider->generateCode($date);
        $request['code'] = $code['code'];

        //Save Purchase
        $purchase = $this->purchaseProvider->store($request);

        $data = [];
        if ($purchase) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['purchase'] = $purchase;
            //Delete Cache
            Cache::forget('purchases');
            //Send Emails
            if($purchase->idstatuspurchase == 1) {
                $this->mailer->byRoles('purchase_draft', $purchase, ['Resources','Admin']);
            }
            //Stream
            $provider = Provider::find($request['provider']);
            event(new Stream(['description' => "ingresó la Orden de Compra " . $request['code'] . " asociada al proveedor $provider->name"]));
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     * GET /purchases/{idpurchase}
     * @param  int $idpurchase
     * @return Response
     */
    public function show($idpurchase)
    {
        return response()->json($this->purchaseProvider->find($idpurchase));
    }

    /**
     * Edit Purchase
     * @param $purchase
     * @param Request $request
     * @return Response
     */
    public function edit($purchase, Request $request){
        return view('purchases.edit')
            ->withPurchase($this->purchaseProvider->find($purchase))
            ->withStatuses($this->statuspurchaseRepository->all()->lists('name', 'idstatuspurchase'))
            ->withProviders($this->providerRepository->all()->lists('name','idprovider'))
            ->withSort($request['sort'])
            ->withOrder($request['order'])
            ->withPage($request['page']);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $idpurchase
     * @param PurchaseRequest $request
     * @return Response
     */
    public function update($idpurchase,PurchaseRequest $request)
    {
        //Update Purchase
        $purchase = $this->purchaseProvider->update($idpurchase, $request);

        $data = [];
        if ($purchase) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            //Delete Cache
            Cache::forget('purchases');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Update Status.
     * @param PurchaseStatusRequest $request
     * @return Response
     */
    public function statusUpdate(PurchaseStatusRequest $request)
    {
        //Update Purchase
        $purchase = $this->purchaseProvider->updateStatus($request);

        $data = [];
        if ($purchase) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            //Delete Cache
            Cache::forget('purchases');
            //Send Emails
            $purchase =  $this->purchaseProvider->getPurchase($request["purchase"]);
            switch ($purchase->idstatuspurchase){
                case 2:
                    $this->mailer->byRoles('purchase_accepted', $purchase, ['Account','Treasurer','Admin','Resources']);
                    break;
                case 3:
                    $this->mailer->byUsers('purchase_inEvaluation', [$purchase->iduser,1037598950], $purchase);
                    break;
            }
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }



    /**
     * Generate Code
     * @return mixed
     */
    public function generatecode()
    {
        return response()->json($this->purchaseProvider->generateCode());
    }

    /**
     * Get Discount
     * @return mixed
     */
    public function getdiscount()
    {
        return response()->json(Purchases::getDiscounts());
    }


}