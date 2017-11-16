<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Http\Requests\MonitoringtypeindicatorRequest;
use SigeTurbo\Repositories\Monitoringtypeindicator\MonitoringtypeindicatorRepositoryInterface;

class MonitoringtypeindicatorsController extends Controller {
	/**
	 * @var MonitoringtypeindicatorRepositoryInterface
	 */
	private $monitoringtypeindicatorRepository;

	/**
	 * MonitoringtypeindicatorsController constructor.
	 * @param MonitoringtypeindicatorRepositoryInterface $monitoringtypeindicatorRepository
	 */
	public function __construct(MonitoringtypeindicatorRepositoryInterface $monitoringtypeindicatorRepository)
	{
		$this->monitoringtypeindicatorRepository = $monitoringtypeindicatorRepository;
	}

	/**
	 * Display a listing of the resource.
	 * GET /monitoringtypeindicators
	 * @return Response
	 */
	public function index()
	{
		return response()->json($this->monitoringtypeindicatorRepository->all());
	}

	/**
	 * Display the specified resource.
	 * GET /monitoringtypeindicators/{monitoringtypeindicators}
	 * @param  int  $idmonitoringtypeindicators
	 * @return Response
	 */
	public function show($idmonitoringtypeindicators)
	{
		return response()->json($this->monitoringtypeindicatorRepository->find($idmonitoringtypeindicators));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param MonitoringtypeindicatorRequest $request
	 * @return Response
	 */
	public function store(MonitoringtypeindicatorRequest $request)
	{
		//Save Monitoringtypeindicator
		$monitoringtypeindicator = $this->monitoringtypeindicatorRepository->store($request);

		$data = [];
		if ($monitoringtypeindicator) {
			$data['successful'] = true;
			$data['message'] = Lang::get('sige.SuccessSaveMessage');
			$data['monitoringtypeindicator'] = $monitoringtypeindicator;
		} else {
			$data['unsuccessful'] = true;
			$data['message'] = Lang::get('sige.ErrorSaveMessage');
		}
		return response()->json($data);
	}

	/**
	 * Remove the specified resource from storage.
	 * @param  int $idmonitoringtypeindicator
	 * @return Response
	 */
	public function destroy($idmonitoringtypeindicator)
	{

		//Delete Monitoringtypeindicator
		$monitoringtypeindicator = $this->monitoringtypeindicatorRepository->destroy($idmonitoringtypeindicator);

		$data = [];
		if ($monitoringtypeindicator) {
			$data['successful'] = true;
			$data['message'] = Lang::get('sige.SuccessDeleteMessage');
		} else {
			$data['unsuccessful'] = true;
			$data['message'] = Lang::get('sige.ErrorDeleteMessage');
		}
		return response()->json($data);
	}


}