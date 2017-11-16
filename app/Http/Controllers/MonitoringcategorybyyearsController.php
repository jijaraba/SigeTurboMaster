<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use SigeTurbo\Http\Requests\MonitoringcategorybyyearRequest;
use SigeTurbo\Repositories\Monitoringcategorybyyear\MonitoringcategorybyyearRepositoryInterface;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;
use Illuminate\Support\Facades\Lang;

class MonitoringcategorybyyearsController extends Controller
{
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;

    /**
     * @var MonitoringcategorybyyearRepositoryInterface
     */
    private $monitoringcategorybyyearRepository;

    /**
     * MonitoringcategorybyyearsController constructor.
     * @param MonitoringcategorybyyearRepositoryInterface $monitoringcategorybyyearRepository
     */
    public function __construct(YearRepositoryInterface $yearRepository, MonitoringcategorybyyearRepositoryInterface $monitoringcategorybyyearRepository)
    {
        $this->yearRepository = $yearRepository;
        $this->monitoringcategorybyyearRepository = $monitoringcategorybyyearRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /monitoringcategorybyyears
     * @return Response
     */
    public function index()
    {
        return response()->json($this->monitoringcategorybyyearRepository->all());
    }

    /**
     * Display a listing of the resource.
     * GET /monitoringcategorybyyears
     * @return Response
     */
    public function init(Request $request)
    {
        //dd($request);
        $search = [
            'year' => $this->yearRepository->getCurrentYear()->idyear,
            'page' => 1,
            'option' => 'monitoringcategorybyyears'
        ];
        return view('contracts.init')
           // ->withPendings($paginator)
            ->withSearch($search);
    }

    /**
     * Display the specified resource.
     * GET /monitoringcategorybyyears/{idmonitoringcategorybyyear}
     * @param  int $idmonitoringcategorybyyear
     * @return Response
     */
    public function show($idmonitoringcategorybyyear)
    {
        return response()->json($this->monitoringcategorybyyearRepository->find($idmonitoringcategorybyyear));
    }

        /**
     * Store a newly created resource in storage.
     * @param MonitoringcategorybyyearRequest $request
     * @return Response
     */
    public function store(MonitoringcategorybyyearRequest $request)
    {
        //Save Monitoring Category By Year
        $monitoringcategorybyyear = $this->monitoringcategorybyyearRepository->store($request);
        $data = [];
        if ($monitoringcategorybyyear) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['last_insert_id'] = $monitoringcategorybyyear->idmonitoringcategorybyyear;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $idmonitoringcategorybyyear
     * @param MonitoringcategorybyyearRequest $request
     * @return Response
     */
    public function update($idmonitoringcategorybyyear, MonitoringcategorybyyearRequest $request)
    {
        //Update Monitoring Category By Year
        $monitoringcategorybyyear = $this->monitoringcategorybyyearRepository->update($idmonitoringcategorybyyear, $request);
        $data = [];
        if ($monitoringcategorybyyear) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['idmonitoringcategorybyyear'] = $idmonitoringcategorybyyear;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $idmonitoringcategorybyyear
     * @return Response
     */
    public function destroy($idmonitoringcategorybyyear)
    {
        //Delete Monitoring Category By Year
        $monitoringcategorybyyear = $this->monitoringcategorybyyearRepository->destroy($idmonitoringcategorybyyear);

        $data = [];
        if ($monitoringcategorybyyear) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessDeleteMessage');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorDeleteMessage');
        }
        return response()->json($data);
    }

    /**
     * Get Monitoring Categories by Year and Subject
     * GET /monitoringcategorybyyears/getmonitoringcategoriesbyyearandsubject/year/{idyear}/subject/{idsubject}
     * @param $idyear
     * @param $idsubject
     * @return mixed
     */
    public function getmonitoringcategoriesbyyearandsubject($idyear, $idsubject)
    {
        $monitoringcategorybyyears = $this->monitoringcategorybyyearRepository->getMonitoringcategorybyyears($idyear,$idsubject);
        return response()->json($monitoringcategorybyyears);
    }

    /**
     * Display the specified resource.
     * GET /monitoringcategorybyyears/getmonitoringcategorybyyeardetail/
     * @return Response
     */
    public function getmonitoringcategorybyyeardetail(Request $request)
    {
        $monitoringcategorybyyears = $this->monitoringcategorybyyearRepository->getMonitoringcategorybyyearDetail($request["yearId"],$request["idsubject"]);
        return response()->json($monitoringcategorybyyears);
    }
}