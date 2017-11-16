<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Events\Stream;
use SigeTurbo\Http\Requests\VisitorRequest;
use SigeTurbo\Mailer\MailerInterface;
use SigeTurbo\Repositories\Identificationtype\IdentificationtypeRepositoryInterface;
use SigeTurbo\Repositories\Visitor\VisitorRepositoryInterface;
use SigeTurbo\Repositories\Visitortype\VisitortypeRepositoryInterface;
use SigeTurbo\User;
use SigeTurbo\Visitor;

class VisitorsController extends Controller
{
    /**
     * @var VisitorRepositoryInterface
     */
    private $visitorRepository;
    /**
     * @var VisitortypeRepositoryInterface
     */
    private $visitortypeRepository;
    /**
     * @var IdentificationtypeRepositoryInterface
     */
    private $identificationtypeRepository;
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * VisitorsController constructor.
     * @param VisitorRepositoryInterface $visitorRepository
     * @param VisitortypeRepositoryInterface $visitortypeRepository
     * @param IdentificationtypeRepositoryInterface $identificationtypeRepository
     * @param MailerInterface $mailer
     */
    public function __construct(VisitorRepositoryInterface $visitorRepository, VisitortypeRepositoryInterface $visitortypeRepository, IdentificationtypeRepositoryInterface $identificationtypeRepository, MailerInterface $mailer)
    {
        $this->visitorRepository = $visitorRepository;
        $this->visitortypeRepository = $visitortypeRepository;
        $this->identificationtypeRepository = $identificationtypeRepository;
        $this->mailer = $mailer;
    }

    /**
     * Display a listing of the resource.
     * GET /visitors
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

        //page
        if (!isset($request['page'])) {
            $request['page'] = 1;
        }

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;
        $visitors =  $this->visitorRepository->all();
        $paginator = new LengthAwarePaginator(
            $visitors->forPage($page, $perPage), $visitors->count(), $perPage, $page
        );
        $paginator->setPath('resources/visitors');
        return view('visitors.index')
            ->withVisitors($paginator)
            ->withSearch($search)
            ->withView($view)
            ->withSort($sort)
            ->withOrder($order);
    }

    /**
     * Visitor Create
     * @return Response
     */
    public function create(){
        return view('visitors.create')
            ->withVisitortypes($this->visitortypeRepository->all()->lists('name', 'idvisitortype'))
            ->withIdentificationtypes($this->identificationtypeRepository->all()->lists('name', 'ididentificationtype'));
    }

    /**
     * Store a newly created resource in storage.
     * @param VisitorRequest $request
     * @return Response
     */
    public function store(VisitorRequest $request)
    {

        //Save Visitor
        $visitor = $this->visitorRepository->store($request);

        $data = [];
        if ($visitor) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['visitor'] = $visitor;
            //Delete Cache
            Cache::forget('visitors');
            //Send Emails
            $user = getUser();
            $this->mailer->byUser('visitor_new',$user->iduser,['description' => "Hola ". $user->firstname .", notificaste el ingreso del visitante " . $request['name'] . " para el día " . $request['date'] . " a las " . $request['time']]);
            //Stream
            event(new Stream(['description' => "ingresó un Permiso de Ingreso para " . $request['name'] . " el día " . $request['date']]));
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     * GET /visitors/{idvisitor}
     * @param  int $idvisitor
     * @return Response
     */
    public function show($idvisitor)
    {
        return response()->json($this->visitorRepository->find($idvisitor));
    }

    /**
     * Edit Visitors.
     * GET /visitors/edit/{idvisitor}
     * @param  int $idvisitor
     * @return Response
     */
    public function edit($idvisitor)
    {
        return view('visitors.edit')
            ->withVisitortypes($this->visitortypeRepository->all()->lists('name', 'idvisitortype'))
            ->withIdentificationtypes($this->identificationtypeRepository->all()->lists('name', 'ididentificationtype'))
            ->withVisitor($this->visitorRepository->find($idvisitor));
    }

    /**
     * Update the specified resource in storage.
     * @param  int $idvisitor
     * @param VisitorRequest $request
     * @return Response
     */
    public function update($idvisitor,VisitorRequest $request)
    {
        //Update Visitor
        $visitor = $this->visitorRepository->update($idvisitor, $request);

        $data = [];
        if ($visitor) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            //Delete Cache
            Cache::forget('visitors');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Destroy the specified resource in storage.
     * @param  int $idvisitor
     * @return Response
     */
    public function destroy($idvisitor)
    {

        //Destroy Visitor
        $visitor = $this->visitorRepository->destroy($idvisitor);

        $data = [];
        if ($visitor) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessDeleteMessage');
            //Delete Cache
            Cache::forget('visitors');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorDeleteMessage');
        }
        return redirect()->route('resources.visitors.index')->withCookie("sigeTurbo",'121');
    }

    /**
     * Generate Code
     * @return mixed
     */
    public function generatecode()
    {
        return response()->json($this->visitorRepository->generateCode());
    }

    /**
     * Get Visitors Now
     * @return mixed
     */
    public function getvisitorsnow()
    {
        return response()->json($this->visitorRepository->getVisitorsNow());
    }

    /**
     * Get Visitors Now For Display
     * @return mixed
     */
    public function getvisitorsnowfordisplay()
    {
        return response()->json($this->visitorRepository->getVisitorsNow())->setCallback(Input::get('callback'));
    }

    /**
     * Checkin
     * @param Request $request
     * @return mixed
     */
    public function checkin(Request $request)
    {
        //Save Checkin
        $visitor = $this->visitorRepository->checkin($request);

        $data = [];
        if ($visitor) {
            //Find Visitor
            $visitor = $this->visitorRepository->find($request['visitor']);
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['visitor'] = $visitor;
            //Delete Cache
            Cache::forget('visitors');
            //Send Emails
            $user = User::find($visitor->created_by);
            $this->mailer->byUser('visitor_checkin',$user->iduser,['description' => "Hola ". $user->firstname .", desde portería notifican que ingresó el visitante " . $visitor['name'] . " con destino a " . $visitor->destination]);
            //Stream
            event(new Stream(['description' => "reporta que ingresó el visitante " . $visitor->name . " con destino a " . $visitor->destination]));
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Checkout
     * @param Request $request
     * @return mixed
     */
    public function checkout(Request $request)
    {
        //Save Checkin
        $visitor = $this->visitorRepository->checkout($request);

        $data = [];
        if ($visitor) {
            //Find Visitor
            $visitor = $this->visitorRepository->find($request['visitor']);
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['visitor'] = $visitor;
            //Delete Cache
            Cache::forget('visitors');
            //Send Emails
            $user = User::find($visitor->created_by);
            $this->mailer->byUser('visitor_checkout',$user->iduser,['description' => "Hola ". $user->firstname .", desde portería notifican que salió el visitante " . $visitor['name'] . " el cual se encontraba en " . $visitor->destination]);
            //Stream
            event(new Stream(['description' => "reporta que salió el visitante " . $visitor->name . " que se encontraba en " . $visitor->destination]));
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

}