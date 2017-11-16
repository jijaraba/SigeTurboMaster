<?php

namespace SigeTurbo\Repositories\Attendancecontrol;

interface AttendancecontrolRepositoryInterface {
    public function all();
    public function find($idattendancecontrol);
}