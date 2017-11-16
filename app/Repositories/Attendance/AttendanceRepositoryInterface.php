<?php

namespace SigeTurbo\Repositories\Attendance;

interface AttendanceRepositoryInterface
{
    public function all();
    public function find($idattendance);
    public function store($data);
    public function edit($attendance);
    public function showByStudent($data);
    public function update($attendance,$data);
    public function delete($attendance);
    public function getAttendancesAmount();
    public function getAttendancesAmountByDate($year);
    public function getAttendancesLevel01Today();
    public function getAttendancesLevel02Today();
    public function getAttendancesLevel03Today();
}