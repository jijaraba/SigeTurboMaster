<?php

namespace SigeTurbo\Http\Controllers;

use SigeTurbo\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SigeTurbo\Repositories\Statusschooltype\StatusschooltypeRepositoryInterface;

class StatusschooltypesController extends Controller
{
    /**
     * @var StatusschooltypeRepositoryInterface
     */
    private $statusschooltypeRepository;

    /**
     * StatusschooltypesController constructor.
     * @param StatusschooltypeRepositoryInterface $statusschooltypeRepository
     */
    public function __construct(StatusschooltypeRepositoryInterface $statusschooltypeRepository)
    {
        $this->statusschooltypeRepository = $statusschooltypeRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /statusschooltypes
     * @return Response
     */
    public function index()
    {
        return response()->json($this->statusschooltypeRepository->all());
    }


    /**
     * Display the specified resource.
     * GET /statusschooltypes/{idstatusschooltype}
     * @param  int $idstatusschooltype
     * @return Response
     */
    public function show($idstatusschooltype)
    {
        return response()->json($this->statusschooltypeRepository->find($idstatusschooltype));
    }


}