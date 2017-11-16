<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Repositories\Status\StatusRepositoryInterface;

class StatusesController extends Controller {


    /**
     * @var StatusRepositoryInterface
     */
    private $statusRepository;

    /**
     * @param StatusRepositoryInterface $statusRepository
     */
    function __construct(StatusRepositoryInterface $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    /**
	 * Display a listing of the resource.
	 * GET /statuses
	 * @return Response
	 */
	public function index()
	{
		return response()->json($this->statusRepository->all());
	}

	/**
	 * Display the specified resource.
	 * GET /statuses/{idstatus}
	 * @param  int  $idstatus
	 * @return Response
	 */
	public function show($idstatus)
	{
		return response()->json($this->statusRepository->find($idstatus));
	}


}