<?php

namespace SigeTurbo\Repositories\Attendancecontrol;

use SigeTurbo\Attendancecontrol;

class AttendancecontrolRepository implements AttendancecontrolRepositoryInterface
{
    /**
     * @return mixed
     */
    public function all()
    {
        return Attendancecontrol::all();
    }

    /**
     * @param $idattendancecontrol
     * @return mixed
     */
    public function find($idattendancecontrol)
    {
        return Attendancecontrol::find($idattendancecontrol);
    }

        /**
     * Save Attendance Controls
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Attendancecontrol::create(array(
            'iduser' => $data['iduser'],
            'date' => $data['date'],
            'time' => $data['time'],
            'observation' => $data['observation'],
            'created_by' => getUser()->iduser
        ));
    }

    /**
     * Update Attendance Controls
     * @param $idattendancecontrol
     * @param $data
     * @return mixed
     */
    public function update($idattendancecontrol, $data)
    {
        $idattendancecontrol = Attendancecontrol::find($idattendancecontrol);
        $idattendancecontrol->fill(array(
            'date' => $data['date'],
            'time' => $data['time'],
            'observation' => $data['observation'],
            'updated_by' => getUser()->iduser
        ));
        return $idattendancecontrol->save();
    }
}