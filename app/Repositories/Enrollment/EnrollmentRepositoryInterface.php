<?php

namespace SigeTurbo\Repositories\Enrollment;

interface EnrollmentRepositoryInterface
{
    public function all();
    public function find($idenrollment);
    public function store($data);
    public function update($enrollment, $data);
    public function getEnrollments($year, $group = null, $category = [], $types = [], $search = null, $sort = null, $order = 'ASC', $exclude = []);
    public function getEnrollmentsByStudent($student);
    public function getEnrollmentsLatestByStudent($student);
    public function getEnrollmentLatestByStudentWithCost($student, $year);
    public function getEnrollmentsWithGrades($year, $period, $group, $subject, $nivel);
    public function getEnrollmentsWithData($year, $period, $group, $subject, $nivel, $category = 13);
    public function getEnrollmentsWithPartial($year, $period, $group, $subject, $nivel, $category = 13);
    public function getEnrollmentsWithDescriptivereport($year, $period, $group, $subject, $nivel, $category = 13);
    public function getEnrollmentsWithAttendance($year, $period, $group, $subject, $nivel, $date, $category = 13);
    public function getEnrollmentsWithObservers($year, $group, $category = [13], $types = [1, 5, 6, 11]);
    public function getEnrollmentsByStatus($year, $status);
    public function getEnrollmentByYearAndUser($year, $student);
    public function getEnrollmentAttendacessList($year, $group);
}