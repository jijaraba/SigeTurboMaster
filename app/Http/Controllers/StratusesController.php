<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Repositories\Stratus\StratusRepositoryInterface;

/**
 * Class StratusesController
 */
class StratusesController extends Controller {

	private $stratusRepository;

    /**
     * @param StratusRepositoryInterface $stratusRepository
     */
    function __construct(StratusRepositoryInterface $stratusRepository)
    {
        $this->stratusRepository = $stratusRepository;
    }

    /**
	 * Display a listing of the resource.
	 * GET /stratuses
	 * @return Response
	 */
	public function index()
	{
		return response()->json($this->stratusRepository->all());
	}


	/**
	 * Display the specified resource.
	 * GET /stratuses/{idstratus}
	 * @param  int  $idstratus
	 * @return Response
	 */
	public function show($idstratus)
	{
		return response()->json($this->stratusRepository->find($idstratus));
	}


}