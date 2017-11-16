<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Http\Requests\EvaluationPurchaseRequest;
use SigeTurbo\Mailer\MailerInterface;
use SigeTurbo\Repositories\Evaluationpurchase\EvaluationpurchaseRepositoryInterface;
use SigeTurbo\Repositories\Purchase\PurchaseRepositoryInterface;


class EvaluationpurchasesController extends Controller
{
    /**
     * @var EvaluationpurchaseRepositoryInterface
     */
    private $evaluationpurchaseRepository;
    /**
     * @var PurchaseRepositoryInterface
     */
    private $purchaseRepository;
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * EvaluationpurchasesController constructor.
     * @param EvaluationpurchaseRepositoryInterface $evaluationpurchaseRepository
     * @param PurchaseRepositoryInterface $purchaseRepository
     * @param MailerInterface $mailer
     */
    public function __construct(EvaluationpurchaseRepositoryInterface $evaluationpurchaseRepository,
                                PurchaseRepositoryInterface $purchaseRepository, MailerInterface $mailer)
    {
        $this->evaluationpurchaseRepository = $evaluationpurchaseRepository;
        $this->purchaseRepository = $purchaseRepository;
        $this->mailer = $mailer;
    }

    /**
     * Display a listing of the resource.
     * GET /evaluationpurchases
     * @return Response
     */
    public function index()
    {
        return response()->json($this->evaluationpurchaseRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /evaluationpurchases/{idevaluationpurchase}
     * @param  int $idevaluationpurchase
     * @return Response
     */
    public function show($idevaluationpurchase)
    {
        return response()->json($this->evaluationpurchaseRepository->find($idevaluationpurchase));
    }

    /**
     * Store a newly created resource in storage.
     * @param EvaluationPurchaseRequest $request
     * @return Response
     */
    public function store(EvaluationPurchaseRequest $request)
    {
        //Save Evaluation Purchase
        $evaluationpurchase = $this->evaluationpurchaseRepository->store($request);

        $data = [];
        if ($evaluationpurchase) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['detail'] = $evaluationpurchase;
            //Delete Cache
            Cache::forget('purchases');
            //Update Purchase
            if ($request['status'] == 3) {
                $this->purchaseRepository->updateStatus(['purchase' => $request['idpurchase'], 'status' => 4]);
            }
            //Send Email
            $purchase = $this->purchaseRepository->getPurchase($request['idpurchase']);
            $this->mailer->byUsers('purchase_evaluation', [$purchase->iduser,3507641], $purchase);
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }


    /**
     * Get Evaluation By Purchase
     * @param Request $request
     * @return mixed
     */
    public function getEvaluationByPurchase(Request $request){
        return response()->json($this->evaluationpurchaseRepository->getEvaluationByPurchase($request['purchase']));
    }


}