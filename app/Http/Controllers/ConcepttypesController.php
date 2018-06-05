<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use SigeTurbo\Repositories\Concepttype\ConcepttypeRepositoryInterface;

class ConcepttypesController extends Controller
{
    /**
     * @var ConcepttypeRepositoryInterface
     */
    private $concepttypeRepository;

    /**
     * ConcepttypesController constructor.
     * @param ConcepttypeRepositoryInterface $concepttypeRepository
     */
    public function __construct(ConcepttypeRepositoryInterface $concepttypeRepository)
    {
        $this->concepttypeRepository = $concepttypeRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /concepttypes
     * @return Response
     */
    public function index()
    {
        return response()->json($this->concepttypeRepository->all());
    }
}
