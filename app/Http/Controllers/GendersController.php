<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Repositories\Gender\GenderRepositoryInterface;

class GendersController extends Controller {

    /**
     * @var
     */
    private $genderRepository;

    /**
     * @param GenderRepositoryInterface $genderRepository
     */
    function __construct(GenderRepositoryInterface $genderRepository)
    {
        $this->genderRepository = $genderRepository;
    }

    /**
	 * Display a listing of the resource.
	 * GET /genders
	 * @return Response
	 */
	public function index()
	{
		return response()->json($this->genderRepository->all());
	}


	/**
	 * Display the specified resource.
	 * GET /genders/{idgender}
	 * @param  int  $idgender
	 * @return Response
	 */
	public function show($idgender)
	{
		return response()->json($this->genderRepository->find($idgender));
	}

}