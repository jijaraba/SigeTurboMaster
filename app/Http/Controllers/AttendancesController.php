<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Events\Stream;
use SigeTurbo\Http\Requests\AttendanceRequest;
use SigeTurbo\Http\Requests\AttendanceShowRequest;
use SigeTurbo\Repositories\Attendance\AttendanceRepositoryInterface;
use SigeTurbo\Repositories\User\UserRepositoryInterface;
use SigeTurbo\Subject;
use SigeTurbo\User;


class AttendancesController extends Controller
{

    /**
     * @var AttendanceRepositoryInterface
     */
    private $attendanceRepository;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @param AttendanceRepositoryInterface $attendanceRepository
     * @param UserRepositoryInterface $userRepository
     */
    function __construct(AttendanceRepositoryInterface $attendanceRepository,
                         UserRepositoryInterface $userRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /attendances
     * @return Response
     */
    public function index()
    {
        return view('attendances.index');
    }

    /**
     * Display the specified resource.
     * GET /attendances/{idattendance}
     * @param  int $idattendance
     * @return Response
     */
    public function show($idattendance)
    {
        return response()->json($this->attendanceRepository->find($idattendance));
    }

    /**
     * Store a newly created resource in storage.
     * @param AttendanceRequest $request
     * @return Response
     */
    public function store(AttendanceRequest $request)
    {
        //Save Attendance
        $attendance = $this->attendanceRepository->store($request);
        $data = [];
        if ($attendance) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['last_insert_id'] = $attendance->idattendance;
            //Stream
            $student = User::find($request['user']);
            $subject = Subject::find($request['subject']);
            event(new Stream(['description' => "ingresó una Falta de Asistencia para $student->firstname $student->lastname en $subject->name (" . $request['type'] . ")"]));
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $idattendance
     * @param AttendanceRequest $request
     * @return Response
     */
    public function update($idattendance, AttendanceRequest $request)
    {

        //Update attendance
        $attendance = $this->attendanceRepository->update($idattendance, $request);
        $data = [];
        if ($attendance) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $idattendance
     * @return Response
     */
    public function destroy($idattendance)
    {

        //Delete Attendance
        $attendance = $this->attendanceRepository->delete($idattendance);
        $data = [];
        if ($attendance) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessDeleteMessage');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorDeleteMessage');
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $attendance
     * @return Response
     */
    public function delete($attendance)
    {

        //Delete Attendance
        $attendance = $this->attendanceRepository->delete($attendance);
        if ($attendance) {
            return redirect()
                ->back()
                ->withSuccess(Lang::get('sige.SuccessDeleteMessage'));
        } else {
            return redirect()
                ->back()
                ->withWarning(Lang::get('sige.ErrorDeleteMessage'));
        }
    }


    /**
     * Get Attendances Amount
     * @return mixed
     */
    public function getAttendancesAmount()
    {
        return response()->json($this->attendanceRepository->getAttendancesAmount());
    }

    /**
     * Show Attendances By Student
     * @param AttendanceShowRequest $request
     * @return $this
     */
    public function showByStudent(AttendanceShowRequest $request)
    {
        return view('attendances.showbystudent')
            ->withAttendances($this->attendanceRepository->showByStudent($request))
            ->withStudent($this->userRepository->find($request["student"]));

    }

    /**
     * Get Attendances Amount By Date
     * @param Request $request
     * @return mixed
     */
    public function getAttendancesAmountByDate(Request $request){
        return response()->json($this->attendanceRepository->getAttendancesAmountByDate($request['year']));
    }

}