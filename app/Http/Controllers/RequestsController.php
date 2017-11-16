<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SigeTurbo\Repositories\Request\RequestRepositoryInterface;
use Illuminate\Support\Facades\Lang;

class RequestsController extends Controller
{

    /**
     * @var RequestRepositoryInterface
     */
    private $requestRepository;

    /**
     * RequestsController constructor.
     * @param RequestRepositoryInterface $requestRepository
     */
    public function __construct(RequestRepositoryInterface $requestRepository)
    {
        $this->requestRepository = $requestRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /groupdirectors
     * @return Response
     */
    public function index()
    {   
        $search = [
            'iduser' =>  getUser()->iduser,
            'page' => 1
        ];

        if (isset($request['search'])) {
            $search = json_decode($request['search'], true);
        }

        //Status
        if (isset($request['iduser'])) {
            $search['iduser'] = $request['iduser'];
        }
        
        $requests = $this->requestRepository->getRequestsByUsers($search['iduser']);

        return view('users.request')
            ->withSearch($search)
            ->withRequests($requests)
            ;
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
            'option' => 'groupdirectors'
        ];
        return view('contracts.init')
           // ->withPendings($paginator)
            ->withSearch($search);
    }


    /**
     * Display the specified resource.
     * GET /groupdirectors/{idgroupdirector}
     * @param $idgroupdirector
     * @return Response
     */
    public function show($idgroupdirector)
    {
        return response()->json($this->requestRepository->find($idgroupdirector));
    }

    /**
     * Display the specified resource.
     * GET /getgroupdirectorsbyyear/{idgroupdirector}
     * @param $idgroupdirector
     * @return Response
     */
    public function getgroupdirectorsbyyear(Request $request)
    {

       $groupdirectors = $this->requestRepository->getGroupsDirectorsByYearOrGroups($request["yearId"],$request["groupId"]);
       return response()->json($groupdirectors);
    }

    /**
     * Store a newly created resource in storage.
     * @param ContractRequest $request
     * @return Response
     */
    public function store(RequestRepositoryInterface $request)
    {
        //Save Group Director
        $groupdirector = $this->requestRepository->store($request);
        $data = [];
        if ($groupdirector) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['last_insert_id'] = $groupdirector->idgroupdirector;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $idcontract
     * @param Request $request
     * @return Response
     */
    public function update($idgroupdirector, RequestRepositoryInterface $request)
    {
        //Update Group Director
        $groupdirector = $this->requestRepository->update($idgroupdirector, $request);
        $data = [];
        if ($groupdirector) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['idgroupdirector'] = $idgroupdirector;
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
    public function destroy($idgroupdirector)
    {
        //Delete Descriptivereport
        $groupdirector = $this->requestRepository->destroy($idgroupdirector);

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