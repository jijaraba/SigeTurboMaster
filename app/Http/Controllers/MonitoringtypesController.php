<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use SigeTurbo\Events\Stream;
use SigeTurbo\Http\Requests\MonitoringtypeRequest;
use SigeTurbo\Monitoringtypeindicator;
use SigeTurbo\Repositories\Indicator\IndicatorRepositoryInterface;
use SigeTurbo\Repositories\Monitoringtype\MonitoringtypeRepositoryInterface;
use SigeTurbo\Subject;

class MonitoringtypesController extends Controller
{
    /**
     * @var MonitoringtypeRepositoryInterface
     */
    private $monitoringtypeRepository;
    /**
     * @var IndicatorRepositoryInterface
     */
    private $indicatorRepository;

    /**
     * MonitoringtypesController constructor.
     * @param MonitoringtypeRepositoryInterface $monitoringtypeRepository
     * @param IndicatorRepositoryInterface $indicatorRepository
     */
    public function __construct(MonitoringtypeRepositoryInterface $monitoringtypeRepository,
                                IndicatorRepositoryInterface $indicatorRepository)
    {
        $this->monitoringtypeRepository = $monitoringtypeRepository;
        $this->indicatorRepository = $indicatorRepository;
    }


    /**
     * Display a listing of the resource.
     * GET /monitoringtypes
     * @return Response
     */
    public function index()
    {
        return view('monitoringtypes.index');
    }

    /**
     * Display the specified resource.
     * GET /monitoringtypes/{idmonitoringtype}
     * @param  int $idmonitoringtype
     * @return Response
     */
    public function show($idmonitoringtype)
    {
        return response()->json($this->monitoringtypeRepository->find($idmonitoringtype));
    }

    /**
     * Save Monitoringtype
     * @param MonitoringtypeRequest $request
     * @return mixed
     * @throws \Exception
     */
    public function store(MonitoringtypeRequest $request)
    {
        $data = [];
        DB::beginTransaction();
        try {
            $monitoringtype = $this->monitoringtypeRepository->store($request);
            if ($monitoringtype) {
                $data['successful'] = true;
                $data['message'] = Lang::get('sige.SuccessSaveMessage');
                $data['last_insert_id'] = $monitoringtype->idmonitoringtype;
                //Generate Indicators Code
                $indicators = $this->indicatorRepository->getIndicatorsByConsecutive($request);
                if (count($indicators) <= 0) {
                    throw new \Exception('Indicators Not Found');
                }
                foreach ($indicators as $indicator) {
                    Monitoringtypeindicator::create(array(
                        'idmonitoringtype' => $data['last_insert_id'],
                        'idindicator' => $indicator->idindicator
                    ));
                }
                //Delete Cache
                Cache::forget('monitoringtype_' . $request['year'] . $request['period'] . $request['group'] . $request['subject'] . $request['nivel'] . $request['monitoringcategory']);
                Cache::forget('monitoringtype_' . $request['year'] . $request['period'] . $request['group'] . $request['subject'] . $request['nivel']);
                //Stream
                $subject = Subject::find($request['subject']);
                event(new Stream(['description' => "ingresó un Tipo de Seguimiento para la asignatura $subject->name"]));
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
     * Remove the specified resource from storage.
     * @param  int $idmonitoringtype
     * @param Request $request
     * @return Response
     */
    public function destroy($idmonitoringtype, Request $request)
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
        //Find Monitoringtype
        $monitoringtype = $this->monitoringtypeRepository->destroy($idmonitoringtype);
        $data = [];
        if ($monitoringtype) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessDeleteMessage');
            //Delete Cache
            Cache::forget('monitoringtype_' . $request['year'] . $request['period'] . $request['group'] . $request['subject'] . $request['nivel']);
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorDeleteMessage');
        }
        return response()->json($data);
    }

    /**
     * Display Monitoring types by Groups And Chart
     * @param Request $request
     * @return string
     */
    public function getmonitoringtypesbygroupchart(Request $request)
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
        $monitoringtypes = $this->monitoringtypeRepository->getMonitoringtypesForChart($request);
        return response()->json($monitoringtypes);
    }

    /**
     * Display Monitoring types by Groups And Chart
     * @param Request $request
     * @return string
     */
    public function getmonitoringtypesbygroup(Request $request)
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
        $monitoringtypes = $this->monitoringtypeRepository->getMonitoringtypes($request);
        return response()->json($monitoringtypes);
    }

    /**
     * Display Monitoring types by Category
     * @return string
     */
    public function getmonitoringtypesbycategory(Request $request)
    {
        $monitoringtypes = $this->monitoringtypeRepository->getMonitoringByCategory($request);
        return response()->json($monitoringtypes);
    }

}