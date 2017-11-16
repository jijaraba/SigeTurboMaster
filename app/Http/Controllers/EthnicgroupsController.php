<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Repositories\Ethnicgroup\EthnicgroupRepositoryInterface;


class EthnicgroupsController extends Controller {

    /**
     * @var
     */
    private $ethnicgroupRepository;

    /**
     * @param EthnicgroupRepositoryInterface $ethnicgroupRepository
     */
    function __construct(EthnicgroupRepositoryInterface $ethnicgroupRepository)
    {
        $this->ethnicgroupRepository = $ethnicgroupRepository;
    }

    /**
	 * Display a listing of the resource.
	 * GET /ethnicgroups
	 * @return Response
	 */
	public function index()
	{
		return response()->json($this->ethnicgroupRepository->all());
	}

	/**
	 * Display the specified resource.
	 * GET /ethnicgroups/{idethnicgroup}
	 * @param  int  $idethnicgroup
	 * @return Response
	 */
	public function show($idethnicgroup)
	{
		return response()->json($this->ethnicgroupRepository->find($idethnicgroup));
	}

}