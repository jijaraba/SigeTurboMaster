<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Repositories\Route\RouteRepositoryInterface;
use SigeTurbo\Route;


class RoutesController extends Controller {

    /**
     * @var RouteRepositoryInterface
     */
    private $routeRepository;

    /**
     * @param RouteRepositoryInterface $routeRepository
     */
    function __construct(RouteRepositoryInterface $routeRepository)
    {
        $this->routeRepository = $routeRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /routes
     * @return Response
     */
    public function index()
    {
        return response()->json($this->routeRepository->all());
    }

	/**
	 * Store a newly created resource in storage.
	 * POST /routes
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//Save Routes
        $route= $this->routeRepository->store($request);
        $data = [];
        if ($route) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            Cache::forget('routes');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
	}

    /**
     * Update the specified resource in storage.
     * @param  int $idroute
     * @param Request $request
     * @return Response
     */
    public function update($idroute, Request $request)
    {
        //Update Route
        $route = $this->routeRepository->update($idroute, $request);
        $data = [];
        if ($route) {
            $data['successful'] = true;
            $data['route'] = $route;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            Cache::forget('routes');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /route/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        //Delete Route
        $route= $this->routeRepository->destroy($id);

        $data = [];
        if ($route) {
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