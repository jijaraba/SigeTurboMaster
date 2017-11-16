<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Http\Requests;
use SigeTurbo\Repositories\Ubication\UbicationRepositoryInterface;

class UbicationsController extends Controller
{
    /**
     * @var UbicationRepositoryInterface
     */
    private $ubicationRepository;

    /**
     * UbicationsController constructor.
     * @param UbicationRepositoryInterface $ubicationRepository
     */
    public function __construct(UbicationRepositoryInterface $ubicationRepository)
    {
        $this->ubicationRepository = $ubicationRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /ubications
     * @return Response
     */
    public function index()
    {
        return response()->json($this->ubicationRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /ubications/{idubication}
     * @param  int  $idubication
     * @return Response
     */
    public function show($idubication)
    {
        return response()->json($this->ubicationRepository->find($idubication));
    }

    /**
     * Get Ubication
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUbications(){
        $excludeSector = [20];
        return response()->json($this->ubicationRepository->getUbications($excludeSector)->prepend(['idubication' => 0, 'name' => Lang::get('sige.All'), 'sector' => 0]));
    }

}
