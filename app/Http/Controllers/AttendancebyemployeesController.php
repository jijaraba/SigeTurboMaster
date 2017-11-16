<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use SigeTurbo\Events\Stream;
use SigeTurbo\Http\Requests\AttendancebyemployeeRequest;
use SigeTurbo\Attendancebyemployee;
use SigeTurbo\Repositories\Attendancebyemployee\AttendancebyemployeeRepositoryInterface;

class AttendancebyemployeesController extends Controller
{
    /**
     * @var AttendancebyemployeeRepositoryInterface
     */
    private $attendancebyemployeeRepository;

    /**
     * AttendancebyemployeeController constructor.
     * @param PermissionRepositoryInterface $permissionRepository
     */
    public function __construct(AttendancebyemployeeRepositoryInterface $attendancebyemployeeRepository)
    {
        $this->attendancebyemployeeRepository = $attendancebyemployeeRepository;
    }


    /**
     * Display a listing of the resource.
     * GET /Attendances by Employee 
     * @return Response
     */
    public function index()
    {
        return view('permission.index');
    }

    /**
     * Display the specified resource.
     * GET /attendancebyemployee/{idattendancebyemployee}
     * @param  int $idattendancebyemployee
     * @return Response
     */
    public function show($idattendancebyemployee)
    {
        return response()->json($this->attendancebyemployeeRepository->find($idattendancebyemployee));
    }

    /**
     * Save Permission
     * @param PermissionRequest $request
     * @return mixed
     * @throws \Exception
     */
    public function store(AttendancebyemployeeRequest $request)
    {
        //Save Permission
        $attendancebyemployee = $this->attendancebyemployeeRepository->store($request);

        $data = [];
        if ($attendancebyemployee) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['attendancebyemployee'] = $attendancebyemployee;
        } else {
            $data['unsuccessful'] = false;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Update  Attendance By Employee.
     * @param  int $idattendancebyemployee
     * @param Request $request
     * @return Response
     */
    public function update($idattendancebyemployee, Request $request)
    {
        //Update attendance By Employee
        $attendancebyemployee = $this->attendancebyemployeeRepository->update($idattendancebyemployee, $request);
        $data = [];
        if ($attendancebyemployee) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['idpermission'] = $idpermission;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

}