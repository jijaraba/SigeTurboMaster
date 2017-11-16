<?php

namespace SigeTurbo\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SigeTurbo\Repositories\Academic\AcademicRepositoryInterface;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;
use Illuminate\Support\Facades\Lang;

class AcademicsController extends Controller
{
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;

    /**
     * @var AcademicRepositoryInterface
     */
    private $academicRepository;

    /**
     * AcademicsController constructor.
     * @param AcademicRepositoryInterface $academicRepository
     * @param YearRepositoryInterface $yearRepository
     */
    public function __construct(YearRepositoryInterface $yearRepository, AcademicRepositoryInterface $academicRepository)
    {
        $this->yearRepository = $yearRepository;
        $this->academicRepository = $academicRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /academics
     * @return Response
     */
    public function index()
    {
        return response::json($this->academicRepository->all());
    }

    /**
     * Display a listing of the resource.
     * GET /groupdirectors
     * @return Response
     */
    public function init(Request $request)
    {
        //dd($request);
        $search = [
            'year' => $this->yearRepository->getCurrentYear()->idyear,
            'page' => 1,
            'option' => 'academics'
        ];
        return view('contracts.init')
           // ->withPendings($paginator)
            ->withSearch($search);
    }

    /**
     * Display the specified resource.
     * GET /academics/{idacademic}
     * @param  int $idacademic
     * @return Response
     */
    public function show($idacademic)
    {
        return response::json($this->academicRepository->find($idacademic));
    }

    /**
     * Get Periods By Year
     * @param Request $request
     * @return mixed
     */
    public function getperiodsbyyear($idyear)
    {
        return response()->json($this->academicRepository->getPeriodsByYear($idyear));
    }

    /**
     * Display the specified resource.
     * GET /getacademicsbyyear/{idacademic}
     * @param $idacademic
     * @return Response
     */
    public function getacademicsbyyear($idyear,Request $request)
    {

       $academics = $this->academicRepository->getAcademicsByYear($idyear,$request["idperiod"]);
       //dd($this->academicRepository->getQuerySyntax($academics));
       return response()->json($academics);
    }

    /**
     * Store a newly created resource in storage.
     * @param AcademicRequest $request
     * @return Response
     */
    public function store(Request $request)
    {
        //Save Academic
        $academic = $this->academicRepository->store($request);
        $data = [];
        if ($academic) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['last_insert_id'] = $academic->idacademic;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $idacademic
     * @param AcademicRequest $request
     * @return Response
     */
    public function update($idacademic, Request $request)
    {
        //Update Academic
        $academic = $this->academicRepository->update($idacademic, $request);
        $data = [];
        if ($academic) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['idacademic'] = $idacademic;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $iddescriptivereport
     * @param DescriptivereportRequest $request
     * @return Response
     */
    public function destroy($idacademic)
    {
        //Delete Academic
        $groupdirector = $this->academicRepository->destroy($idacademic);

        $data = [];
        if ($groupdirector) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessDeleteMessage');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorDeleteMessage');
        }
        return response()->json($data);
    }
}