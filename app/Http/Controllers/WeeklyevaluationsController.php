<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Calendar\Calendar;
use SigeTurbo\Events\Stream;
use SigeTurbo\Notifications\Notifications;
use SigeTurbo\Http\Requests\WeeklyevaluationRequest;
use SigeTurbo\Points\Points;
use SigeTurbo\Repositories\Weeklyevaluation\WeeklyevaluationRepositoryInterface;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;


class WeeklyevaluationsController extends Controller
{
    /**
     * @var WeeklyevaluationRepositoryInterface
     */
    private $weeklyevaluationRepository;
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;


    /**
     * WeeklyevaluationsController constructor.
     * @param WeeklyevaluationRepositoryInterface $weeklyevaluationRepository
     * @param YearRepositoryInterface $yearRepository
     */
    public function __construct(WeeklyevaluationRepositoryInterface $weeklyevaluationRepository, YearRepositoryInterface $yearRepository)
    {
        $this->weeklyevaluationRepository = $weeklyevaluationRepository;
        $this->yearRepository = $yearRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /weeklyevaluations
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
        $sort = 'week';
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
        $weeklyevaluations = $this->weeklyevaluationRepository->getEvaluations($this->yearRepository->getCurrentYear()->idyear, $sort, strtoupper($order));
        $paginator = new LengthAwarePaginator(
            $weeklyevaluations->forPage($page, $perPage), $weeklyevaluations->count(), $perPage, $page
        );
        $paginator->setPath('communications/weeklyevaluations');
        return view('weeklyevaluations.index')
            ->withWeeklyevaluations($paginator)
            ->withSearch($search)
            ->withView($view)
            ->withSort($sort)
            ->withOrder($order);
    }

    /**
     * Display the specified resource.
     * GET /weeklyevaluations/{idweeklyevaluation}
     * @param int $idweeklyevaluation
     * @return Response
     */
    public function show($idweeklyevaluation)
    {
        return response()->json($this->weeklyevaluationRepository->find($idweeklyevaluation));
    }

    /**
     * Get Evaluations By Years
     * @param Request $request
     * @return mixed
     */
    public function getEvaluations(Request $request)
    {
        return response()->json($this->weeklyevaluationRepository->getEvaluations($request['year'], 'week', 'ASC'));
    }

    /**
     * Create Evaluation
     * @return Response
     */
    public function create()
    {
        return view('weeklyevaluations.create')
            ->withUser(getUser());
    }


    /**
     * Store a newly created resource in storage.
     * @param WeeklyevaluationRequest $request
     * @return Response
     */
    public function store(WeeklyevaluationRequest $request)
    {

        //Save Weeklyevaluation
        $weeklyevaluation = $this->weeklyevaluationRepository->store($request);

        $data = [];
        if ($weeklyevaluation) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['weeklyevaluation'] = $weeklyevaluation;

            //Set Points
            if (Calendar::isWeekday()) {
                Points::setPoints(3);
                $points = 3;
            } else {
                Points::setPoints(1);
                $points = 1;
            }
            //Set Notifications
            Notifications::setNotification("Evaluación Semanal", "¡Felicitaciones!, acabas de obtener $points " . ($points > 1) ? "puntos" : "punto" . "por realizar la evaluación semanal", Carbon::now(), Carbon::now());
            //Stream
            event(new Stream(['description' => "ingresó una Evaluación Semanal"]));
            $message = "Ahora tienes <strong>$points puntos</strong> por realizar la Evaluación Semanal a tiempo";
            if ($points < 3) {
                $message = "Ahora tienes $points punto, procura realizar la evaluación semanal a tiempo";
            }
            $data['points'] = [
                'show' => true,
                'message' => $message,
                'value' => $points
            ];

            $data['notifications'] = [
                'show' => true,
                'notification' => 1
            ];

        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }

        return response()->json($data);
    }

    /**
     * Edit Evaluation
     * @param $weeklyevaluation
     * @param Request $request
     * @return Response
     */
    public function edit($weeklyevaluation, Request $request)
    {

        $weeklyevaluation = $this->weeklyevaluationRepository->find($weeklyevaluation);
        if (!$weeklyevaluation) {
            redirect()->route('communications.weeklyevaluations.index');
        }

        return view('weeklyevaluations.edit')
            ->withWeeklyevaluation($this->weeklyevaluationRepository->find($weeklyevaluation))
            ->withSort($request['sort'])
            ->withOrder($request['order'])
            ->withPage($request['page'])
            ->withUser(getUser());
    }

    /**
     * Update the specified resource in storage.
     * @param  int $idweeklyevaluation
     * @param WeeklyevaluationRequest $request
     * @return Response
     */
    public function update($idweeklyevaluation, WeeklyevaluationRequest $request)
    {
        //Update weeklyevaluation
        $weeklyevaluation = $this->weeklyevaluationRepository->update($idweeklyevaluation, $request);

        $data = [];
        if ($weeklyevaluation) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

}