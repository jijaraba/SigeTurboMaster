<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Repositories\Conveyor\ConveyorRepositoryInterface;
use SigeTurbo\Routebyuser;


class ConveyorsController extends Controller {

    /**
     * @var ConveyorRepositoryInterface
     */
    private $conveyorRepository;

    /**
     * @param ConveyorRepositoryInterface $conveyorRepository
     */
    function __construct(ConveyorRepositoryInterface $conveyorRepository)
    {
        $this->conveyorRepository = $conveyorRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /conveyors
     * @return Response
     */
    public function index()
    {
        return response()->json($this->conveyorRepository->all());
    }

	/**
	 * Store a newly created resource in storage.
	 * POST /conveyors
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//Save Conveyors
        $conveyor= $this->conveyorRepository->store($request);
        $data = [];
        if ($conveyor) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['idconveyor'] = $conveyor['idconveyor'];
            Cache::forget('conveyors');
            //Stream
            //$group = Group::find($request['group']);
            //event(new Stream(['description' => "ingresó una Tarea para el grupo $group->name"]));
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
	}

    /**
     * Update the specified resource in storage.
     * @param  int $idconveyor
     * @param Request $request
     * @return Response
     */
    public function update($idconveyor, Request $request)
    {
        //Update conveyor
        $conveyor = $this->conveyorRepository->update($idconveyor, $request);
        $data = [];
        if ($conveyor) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            Cache::forget('conveyors');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /conveyor/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        //Delete User By Route
        $conveyor= $this->conveyorRepository->destroy($id);

        $data = [];
        if ($conveyor) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessDeleteMessage');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorDeleteMessage');
        }
        return response()->json($data);
	}

}