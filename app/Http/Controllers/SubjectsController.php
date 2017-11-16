<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SigeTurbo\Repositories\Subject\SubjectRepositoryInterface;

class SubjectsController extends Controller
{
    /**
     * @var SubjectRepositoryInterface
     */
    private $subjectRepository;

    /**
     * SubjectsController constructor.
     * @param SubjectRepositoryInterface $subjectRepository
     */
    public function __construct(SubjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /subjects
     * @return Response
     */
    public function index()
    {
        return response()->json($this->subjectRepository->all());
    }

    /**
     * Display a listing of the resource.
     * GET /subjects
     * @return Response
     */
    public function init(Request $request)
    {
        //dd($request);
        $search = [
            'page' => 1,
            'option' => 'subjects'
        ];
        return view('contracts.init')
           // ->withPendings($paginator)
            ->withSearch($search);
    }

    /**
     * Display the specified resource.
     * GET /subjects/{idsubject}
     * @param  int $idsubject
     * @return Response
     */
    public function show($idsubject)
    {
        return response()->json($this->subjectRepository->find($idsubject));
    }

    /**
     * Get Subjects By Year and Period and Group and User
     * @param Request $request
     * @return mixed
     */
    public function getsubjectsbyyearandperiodandgroup(Request $request)
    {

        if (!getGuest()) {
            switch (getUser()->role_selected) {
                case 'Teacher':
                    return response()->json($this->subjectRepository->getSubjects($request['year'], $request['period'], $request['group'], getUser()->iduser));
                    break;
                case 'AreaManager':
                    return response()->json($this->subjectRepository->getSubjectsByArea($request['year'], $request['period'], $request['group'], getUser()->iduser));
                    break;
                default:
                    return response()->json($this->subjectRepository->getSubjects($request['year'], $request['period'], $request['group']));
                    break;
            }
        } else {
            return response()->json($this->subjectRepository->getSubjects($request['year'], $request['period'], $request['group']));
        }
    }

    /**
     * Get Subjects By Year
     * @param Request $request
     * @return mixed
     */
    public function getsubjectsbyyear(Request $request)
    {
        return response()->json($this->subjectRepository->getSubjectsByYear($request['year']));
    }

    /**
     * Get Areas Subjects And Nivels
     * @param Request $request
     * @return mixed
     */
    public function getsubjectwithareasandnivels(Request $request)
    {
        //dd($this->subjectRepository->getQuerySyntax($this->subjectRepository->getSubjectsWithAreasAndNivels()));
        return response()->json($this->subjectRepository->getSubjectsWithAreasAndNivels());
    }
}