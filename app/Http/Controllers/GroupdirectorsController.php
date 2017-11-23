<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;
use SigeTurbo\Repositories\Groupdirector\GroupdirectorRepositoryInterface;
use SigeTurbo\Http\Requests\GroupdirectorRequest;
use Illuminate\Support\Facades\Lang;

class GroupdirectorsController extends Controller
{
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;

    /**
     * @var GroupdirectorRepositoryInterface
     */
    private $groupdirectorRepository;

    /**
     * GroupdirectorsController constructor.
     * @param GroupdirectorRepositoryInterface $groupdirectorRepository
     * @param YearRepositoryInterface $yearRepository
     */
    public function __construct(YearRepositoryInterface $yearRepository, GroupdirectorRepositoryInterface $groupdirectorRepository)
    {
        $this->yearRepository = $yearRepository;
        $this->groupdirectorRepository = $groupdirectorRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /groupdirectors
     * @return Response
     */
    public function index()
    {
        return response()->json($this->groupdirectorRepository->all());
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
        return response()->json($this->groupdirectorRepository->find($idgroupdirector));
    }

    /**
     * Display the specified resource.
     * GET /getgroupdirectorsbyyear/{idgroupdirector}
     * @param $idgroupdirector
     * @return Response
     */
    public function getgroupdirectorsbyyear(Request $request)
    {

        $groupdirectors = $this->groupdirectorRepository->getGroupsDirectorsByYearOrGroups($request["yearId"], $request["groupId"]);
        return response()->json($groupdirectors);
    }

    /**
     * Store a newly created resource in storage.
     * @param ContractRequest $request
     * @return Response
     */
    public function store(GroupdirectorRequest $request)
    {
        //Save Group Director
        $groupdirector = $this->groupdirectorRepository->store($request);
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
    public function update($idgroupdirector, GroupdirectorRequest $request)
    {
        //Update Group Director
        $groupdirector = $this->groupdirectorRepository->update($idgroupdirector, $request);
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
        $groupdirector = $this->groupdirectorRepository->destroy($idgroupdirector);

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