<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Areamanager;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;
use SigeTurbo\Repositories\Areamanager\AreamanagerRepositoryInterface;
use Illuminate\Http\Request;
use SigeTurbo\Http\Requests\AreamanagerRequest;
use Illuminate\Support\Facades\Lang;

class AreamanagersController extends Controller {

    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;

    /**
     * @var AreamanagerRepositoryInterface
     */
    private $areamanagerRepository;

    /**
     * AreamanagersController constructor.
     * @param YearRepositoryInterface $yearRepository
     * @param AreamanagerRepositoryInterface $areamanagerRepository
     */
    public function __construct(YearRepositoryInterface $yearRepository, AreamanagerRepositoryInterface $areamanagerRepository)
    {
        $this->yearRepository = $yearRepository;
        $this->areamanagerRepository = $areamanagerRepository;
    }

	/**
	 * Display a listing of the resource.
	 * GET /areamanagers
	 * @return Response
	 */
	public function index()
	{
		return response()->json(Areamanager::all());
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
            'option' => 'areamanagers'
        ];
        return view('contracts.init')
           // ->withPendings($paginator)
            ->withSearch($search);
    }

	/**
	 * Display the specified resource.
	 * GET /areamanagers/{idareamanager}
	 * @param  int  $idareamanager
	 * @return Response
	 */
	public function show($idareamanager)
	{
		return response()->json(Areamanager::find($idareamanager));
	}

    /**
     * Display the specified resource.
     * GET /getgroupdirectorsbyyear/{idgroupdirector}
     * @param $idgroupdirector
     * @return Response
     */
    public function getareamanagersbyyear(Request $request)
    {

       $areamanagers = $this->areamanagerRepository->getAreaManagersByYearOrGroups($request["yearId"],$request["areaId"]);
       //dd($this->areamanagerRepository->obtenersintaxisconsulta($areamanagers));
       return response()->json($areamanagers);
    }

    /**
     * Store a newly created resource in storage.
     * @param AreamanagerRequest $request
     * @return Response
     */
    public function store(AreamanagerRequest $request)
    {
        //Save Area Manager
        $areamanager = $this->areamanagerRepository->store($request);
        $data = [];
        if ($areamanager) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['last_insert_id'] = $areamanager->idareamanager;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $idareamanager
     * @param AreamanagerRequest $request
     * @return Response
     */
    public function update($idareamanager, AreamanagerRequest $request)
    {
        //Update Area Manager
        $areamanager = $this->areamanagerRepository->update($idareamanager, $request);
        $data = [];
        if ($areamanager) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['idareamanager'] = $idareamanager;
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
    public function destroy($idareamanager)
    {
        //Delete Area Manager
        $areamanager = $this->areamanagerRepository->destroy($idareamanager);

        $data = [];
        if ($areamanager) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessDeleteMessage');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorDeleteMessage');
        }
        return response()->json($data);
    }

}