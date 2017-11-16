<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Repositories\Tasktype\TasktypeRepositoryInterface;

class TasktypesController extends Controller
{
    /**
     * @var TasktypeRepositoryInterface
     */
    private $tasktypeRepository;

    /**
     * TasktypesController constructor.
     * @param TasktypeRepositoryInterface $tasktypeRepository
     */
    public function __construct(TasktypeRepositoryInterface $tasktypeRepository)
    {
        $this->tasktypeRepository = $tasktypeRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /tasktypes
     * @return Response
     */
    public function index()
    {
        return response()->json($this->tasktypeRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /tasks/{idtask}
     * @param  int $idtask
     * @return Response
     */
    public function show($idtask)
    {
        return response()->json($this->tasktypeRepository->find($idtask));
    }


}