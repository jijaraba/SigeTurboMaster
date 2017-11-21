<?php

/**
 * @author José Jaraba <webadm@thenewschool.edu.co>
 * @version 1.0
 */

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use SigeTurbo\Events\Stream;
use SigeTurbo\Group;
use SigeTurbo\Http\Requests\IndicatorRequest;
use SigeTurbo\Indicatorcategory;
use SigeTurbo\Mailer\MailerInterface;
use SigeTurbo\Repositories\Indicator\IndicatorRepositoryInterface;
use SigeTurbo\Repositories\Period\PeriodRepositoryInterface;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;
use SigeTurbo\Subject;

class IndicatorsController extends Controller
{
    /**
     * @var IndicatorRepositoryInterface
     */
    private $indicatorRepository;
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;
    /**
     * @var PeriodRepositoryInterface
     */
    private $periodRepository;
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * IndicatorsController constructor.
     * @param IndicatorRepositoryInterface $indicatorRepository
     * @param YearRepositoryInterface $yearRepository
     * @param PeriodRepositoryInterface $periodRepository
     * @param MailerInterface $mailer
     */
    public function __construct(IndicatorRepositoryInterface $indicatorRepository,
                                YearRepositoryInterface $yearRepository,
                                PeriodRepositoryInterface $periodRepository, MailerInterface $mailer)
    {
        $this->indicatorRepository = $indicatorRepository;
        $this->yearRepository = $yearRepository;
        $this->periodRepository = $periodRepository;
        $this->mailer = $mailer;
    }

    /**
     * Display a listing of the resource.
     * GET /indicators
     * @return Response
     */
    public function index()
    {
        return view('indicators.index');
    }

    /**
     * Display the specified resource.
     * GET /indicators/{idindicator}
     * @param  int $idindicator
     * @return Response
     */
    public function show($idindicator)
    {
        return response()->json($this->indicatorRepository->find($idindicator));
    }


    /**
     * Store a newly created resource in storage.
     * @param IndicatorRequest $request
     * @return Response
     */
    public function store(IndicatorRequest $request)
    {
        $data = [];
        DB::beginTransaction();
        try {
            //Indicator 01
            $indicator01 = $this->indicatorRepository->storeFortitude($request);
            //Indicator 02
            $indicator02 = $this->indicatorRepository->storeRecommendation($request);

            if ($indicator01 && $indicator02) {
                $data['successful'] = true;
                $data['message'] = Lang::get('sige.SuccessSaveMessage');
                $data['last_insert_id'] = $indicator01->idindicator;

                //Delete Cache
                Cache::forget('indicator_' . $request['year'] . $request['period'] . $request['group'] . $request['subject'] . $request['nivel']);

                //Stream
                $group = Group::find($request['group']);
                $subject = Subject::find($request['subject']);
                $indicatorcategory = Indicatorcategory::find($request['indicatorcategory']);
                event(new Stream(['description' => "ingresó indicadores de desempeño para el grupo $group->name"]));

                //Send Emails
                $indicator = [
                    'group' => $group->name,
                    'subject' => $subject->name,
                    'indicator' => $request['fortitude'],
                    'category' => $indicatorcategory->name,
                    'teacher' => getUser()->firstname,
                ];
                if ($request['indicatorcategory'] == Indicatorcategory::INDICATORCATEGORY_DEEPENING || $request['indicatorcategory'] == Indicatorcategory::INDICATORCATEGORY_RELAXATION) {
                    $this->mailer->byRoles('indicator_category', $indicator, ['Admin','Counseling']);
                }
            } else {
                $data['unsuccessful'] = true;
                $data['message'] = Lang::get('sige.ErrorSaveMessage');
            }

        } catch (ValidationException $e) {
            DB::rollback();
        }
        DB::commit();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param $idindicator
     * @param IndicatorRequest $request
     * @return Response
     */
    public function update($idindicator, IndicatorRequest $request)
    {

        $data = [];
        DB::beginTransaction();
        try {
            //Indicator 01
            $indicator01 = $this->indicatorRepository->updateFortitude($idindicator, $request);
            //Indicator 02
            $indicator02 = $this->indicatorRepository->updateRecommendation($request['idindicatorrecomendation'], $request);

            if ($indicator01 && $indicator02) {
                $data['successful'] = true;
                $data['message'] = Lang::get('sige.SuccessUpdateMessage');

                //Delete Cache
                Cache::forget('indicator_' . $request['year'] . $request['period'] . $request['group'] . $request['subject'] . $request['nivel']);

                //Stream
                $group = Group::find($request['group']);
                $subject = Subject::find($request['subject']);
                $indicatorcategory = Indicatorcategory::find($request['indicatorcategory']);
                event(new Stream(['description' => "modificó indicadores de desempeño para el grupo $group->name"]));

                //Send Emails
                $indicator = [
                    'group' => $group->name,
                    'subject' => $subject->name,
                    'indicator' => $request['fortitude'],
                    'category' => $indicatorcategory->name,
                    'teacher' => getUser()->firstname,
                ];
                if ($request['indicatorcategory'] == Indicatorcategory::INDICATORCATEGORY_DEEPENING || $request['indicatorcategory'] == Indicatorcategory::INDICATORCATEGORY_RELAXATION) {
                    $this->mailer->byRoles('indicator_category', $indicator, ['Admin','Counseling']);
                }
            } else {
                $data['unsuccessful'] = true;
                $data['message'] = Lang::get('sige.ErrorUpdateMessage');
            }

        } catch (ValidationException $e) {
            DB::rollback();
        }
        DB::commit();
        return response()->json($data);
    }


    /**
     * Display Indicators by Group
     * @param Request $request
     * @return string
     */
    public function getindicatorsbygroup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required|integer',
            'period' => 'required|integer',
            'group' => 'required|integer',
            'subject' => 'required|integer',
            'nivel' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }
        $indicators = $this->indicatorRepository->getIndicatorsByGroup($request);
        return response()->json($indicators);
    }

    /**
     * Display Indicators
     * @param Request $request
     * @return string
     */
    public function getindicators(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required|integer',
            'period' => 'required|integer',
            'group' => 'required|integer',
            'subject' => 'required|integer',
            'nivel' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }
        $indicators = $this->indicatorRepository->getIndicators($request);
        return response()->json($indicators);
    }

    /**
     * Get Indicators Pending By Teacher
     * @api
     * @return mixed
     */
    public function getIndicatorsPendingByTeacher()
    {

        $data = [];
        $result = $this->indicatorRepository->getIndicatorsPendingByTeacher(
            $this->yearRepository->getCurrentYear()->idyear,
            $this->periodRepository->getCurrentPeriod()->idperiod,
            Auth::guard('api')->user()->iduser);
        if (count($result) > 0) {
            $data = $result;
        }
        return response()->json($data);
    }


}