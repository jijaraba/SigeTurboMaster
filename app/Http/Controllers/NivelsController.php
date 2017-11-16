<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SigeTurbo\Repositories\Nivel\NivelRepositoryInterface;

class NivelsController extends Controller
{
    /**
     * @var NivelRepositoryInterface
     */
    private $nivelRepository;

    /**
     * NivelsController constructor.
     * @param NivelRepositoryInterface $nivelRepository
     */
    public function __construct(NivelRepositoryInterface $nivelRepository)
    {
        $this->nivelRepository = $nivelRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /nivels
     * @return Response
     */
    public function index()
    {
        return response()->json($this->nivelRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /nivels/{idnivel}
     * @param  int $idnivel
     * @return Response
     */
    public function show($idnivel)
    {
        return response()->json($this->nivelRepository->find($idnivel));

    }

    /**
     * Display the specified resource.
     * GET /nivels/{idnivel}
     * @param  int $idnivel
     * @return Response
     */
    public function getnivelsbysubject($idsubject)
    {
        return response()->json($this->nivelRepository->getNivelsBySubject($idsubject));
    }

    /**
     * Get Niveles By Year and Period and Group and Subject and User
     * @param Request $request
     * @return mixed
     */
    public function getnivelsbyyearandperiodandgroupandsubject(Request $request)
    {
        if (!getGuest()) {
            switch (getUser()->role_selected) {
                case 'Teacher':
                    return response()->json($this->nivelRepository->getNivels($request['year'], $request['period'], $request['group'], $request['subject'], getUser()->iduser));
                    break;
                case 'AreaManager':
                    return response()->json($this->nivelRepository->getNivelsByArea($request['year'], $request['period'], $request['group'], $request['subject'], getUser()->iduser));
                    break;
                default:
                    return response()->json($this->nivelRepository->getNivels($request['year'], $request['period'], $request['group'], $request['subject']));
                    break;
            }
        } else {
            return response()->json($this->nivelRepository->getNivels($request['year'], $request['period'], $request['group'], $request['subject']));
        }
    }
}