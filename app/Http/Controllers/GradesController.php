<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Repositories\Grade\GradeRepositoryInterface;

class GradesController extends Controller
{
    /**
     * @var GradeRepositoryInterface
     */
    private $gradeRepository;

    /**
     * GradesController constructor.
     * @param GradeRepositoryInterface $gradeRepository
     */
    public function __construct(GradeRepositoryInterface $gradeRepository)
    {
        $this->gradeRepository = $gradeRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /grades
     * @return Response
     */
    public function index()
    {
        return response()->json($this->gradeRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /grades/{idgrade}
     * @param  int $idgrade
     * @return Response
     */
    public function show($idgrade)
    {
        return response()->json(Grade::find($idgrade));
    }

}