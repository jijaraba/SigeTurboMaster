<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Repositories\Religion\ReligionRepositoryInterface;

class ReligionsController extends Controller {

    /**
     * @var
     */
    private $religionRepository;

    /**
     * @param ReligionRepositoryInterface $religionRepository
     */
    function __construct(ReligionRepositoryInterface $religionRepository)
    {
        $this->religionRepository = $religionRepository;
    }

    /**
	 * Display a listing of the resource.
	 * GET /religions
	 * @return Response
	 */
	public function index()
	{
		return response()->json($this->religionRepository->all());
	}

	/**
	 * Display the specified resource.
	 * GET /religions/{idreligion}
	 * @param  int  $idreligion
	 * @return Response
	 */
	public function show($idreligion)
	{
		return response()->json($this->religionRepository->find($idreligion));
	}


}