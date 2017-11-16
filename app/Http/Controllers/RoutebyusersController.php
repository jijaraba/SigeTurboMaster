<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Repositories\Routebyuser\RoutebyuserRepositoryInterface;
use SigeTurbo\Routebyuser;


class RouteByusersController extends Controller {

    /**
     * @var RouteRepositoryInterface
     */
    private $routebyuserRepository;

    /**
     * @param RouteRepositoryInterface $routeRepository
     */
    function __construct(RoutebyuserRepositoryInterface $routebyuserRepository)
    {
        $this->routebyuserRepository = $routebyuserRepository;
    }

	/**
	 * Store a newly created resource in storage.
	 * POST /typeofpromotions
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//Save Route By user
        $routebyuser = $this->routebyuserRepository->store($request);
        $data = [];
        if ($routebyuser) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['routebyuserRepository'] = $this->routebyuserRepository->getUsersByroute($routebyuser['idroute']);
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
	 * PUT /responsibles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /responsibles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        //Delete User By Route
        $routebyuser = $this->routebyuserRepository->destroy($id);

        $data = [];
        if ($routebyuser) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessDeleteMessage');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorDeleteMessage');
        }
        return response()->json($data);
	}

}