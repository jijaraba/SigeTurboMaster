<?php

namespace SigeTurbo\Repositories\Attendancebyemployee;

use SigeTurbo\Attendancebyemployee;

class AttendancebyemployeeRepository implements AttendancebyemployeeRepositoryInterface
{
    /**
     * @return mixed
     */
    public function all()
    {
        return Attendancebyemployee::all();
    }

    /**
     * @param $idattendancebyemployee
     * @return mixed
     */
    public function find($idattendancebyemployee)
    {
        return Attendancebyemployee::find($idattendancebyemployee);
    }

        /**
     * Save Attendance By Employee
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Attendancebyemployee::create(array(
            'iduser' => $data['iduser'],
            'attendancetype' => $data['attendancetype'],
            'date' => $data['date'],
            'time' => $data['time'],
            'created_by' => getUser()->iduser
        ));
    }

    /**
     * Update Attendance By Employee
     * @param $attendancebyemployee
     * @param $data
     * @return mixed
     */
    public function update($attendancebyemployee, $data)
    {
        $attendancebyemployee = Attendancebyemployee::find($attendancebyemployee);
        $attendancebyemployee->fill(array(
            'time' => $data['time'],
            'updated_by' => getUser()->iduser
        ));
        return $attendancebyemployee->save();
    }

}