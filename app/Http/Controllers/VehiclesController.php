<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Repositories\Vehicle\VehicleRepositoryInterface;
use SigeTurbo\Vehicle;


class VehiclesController extends Controller {

    /**
     * @var VehicleRepositoryInterface
     */
    private $vehicleRepository;

    /**
     * @param VehicleRepositoryInterface $vehicleRepository
     */
    function __construct(VehicleRepositoryInterface $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /vehicles
     * @return Response
     */
    public function index()
    {
        return response()->json($this->vehicleRepository->all());
    }

	/**
	 * Store a newly created resource in storage.
	 * POST /vehicles
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//Save Vehicles
        $vehicle= $this->vehicleRepository->store($request);
        $data = [];
        if ($vehicle) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['idvehicle'] = $vehicle['idvehicle'];
            Cache::forget('vehicles');
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
     * @param  int $idvehicle
     * @param Request $request
     * @return Response
     */
    public function update($idvehicle, Request $request)
    {
        //Update vehicle
        $vehicle = $this->vehicleRepository->update($idvehicle, $request);
        $data = [];
        if ($vehicle) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            Cache::forget('vehicles');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /vehicle/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        //Delete Vehicle
        $vehicle= $this->vehicleRepository->destroy($id);

        $data = [];
        if ($vehicle) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessDeleteMessage');
            Cache::forget('vehicles');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorDeleteMessage');
        }
        return response()->json($data);
	}

}