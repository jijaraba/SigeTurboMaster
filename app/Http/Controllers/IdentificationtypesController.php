<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Identificationtype;
use SigeTurbo\Repositories\Identificationtype\IdentificationtypeRepositoryInterface;

class IdentificationtypesController extends Controller
{
    /**
     * @var IdentificationtypeRepositoryInterface
     */
    private $identificationtypeRepository;

    /**
     * IdentificationtypesController constructor.
     * @param IdentificationtypeRepositoryInterface $identificationtypeRepository
     */
    public function __construct(IdentificationtypeRepositoryInterface $identificationtypeRepository)
    {
        $this->identificationtypeRepository = $identificationtypeRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /identificationtypes
     * @return Response
     */
    public function index()
    {
        return response()->json($this->identificationtypeRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /identificationtypes/{id}
     * @param  int $identificationtype
     * @return Response
     */
    public function show($identificationtype)
    {
        return response()->json($this->identificationtypeRepository->find($identificationtype));
    }

}