<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use SigeTurbo\Events\Stream;
use SigeTurbo\Http\Requests\AttendancecontrolRequest;
use SigeTurbo\Attendancecontrol;
use SigeTurbo\Repositories\Attendancecontrol\AttendancecontrolRepositoryInterface;

class AttendancecontrolsController extends Controller
{
    /**
     * @var AttendancecontrolRepositoryInterface
     */
    private $attendancecontrolRepository;

    /**
     * AttendancecontrolController constructor.
     * @param AttendancecontrolRepositoryInterface $attendancecontrolRepository
     */
    public function __construct(AttendancecontrolRepositoryInterface $attendancecontrolRepository)
    {
        $this->attendancecontrolRepository = $attendancecontrolRepository;
    }


    /**
     * Display a listing of the resource.
     * GET /Attendances by Employee 
     * @return Response
     */
    public function index()
    {
        return response()->json($this->attendancecontrolRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /attendancecontrol/{idattendancecontrol}
     * @param  int $idattendancecontrol
     * @return Response
     */
    public function show($idattendancecontrol)
    {
        return response()->json($this->attendancecontrolRepository->find($idattendancecontrol));
    }

    /**
     * Save Permission
     * @param PermissionRequest $request
     * @return mixed
     * @throws \Exception
     */
    public function store(AttendancecontrolRequest $request)
    {
        //Save Permission
        $attendancecontrol = $this->attendancecontrolRepository->store($request);

        $data = [];
        if ($attendancecontrol) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['attendancecontrol'] = $attendancecontrol;
        } else {
            $data['unsuccessful'] = false;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Update  Attendance Controls.
     * @param  int $idattendancecontrol
     * @param Request $request
     * @return Response
     */
    public function update($idattendancecontrol, Request $request)
    {
        //Update attendance By Employee
        $attendancecontrol = $this->attendancecontrolRepository->update($idattendancecontrol, $request);
        $data = [];
        if ($attendancecontrol) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['idattendancecontrol'] = $idattendancecontrol;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

}