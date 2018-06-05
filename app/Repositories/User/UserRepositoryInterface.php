<?php

namespace SigeTurbo\Repositories\User;

interface UserRepositoryInterface
{
    public function all();
    public function find($iduser);
    public function store($data);
    public function update($user, $data);
    public function updateCelularPasscode($user, $data, $passcode);
    public function updateEmailPasscode($user, $data, $passcode);
    public function updateCelularWithPasscode($user, $data);
    public function updateEmailWithPasscode($user, $data);
    public function updateCelularCertification($user, $data);
    public function updateEmailCertification($user, $data);
    public function getLatest($count);
    public function getLatestCode();
    public function verifyCelular($celular);
    public function verifyEmail($email);
    public function getStudentById($user);
    public function getUserByRole($role);
    public function getUsersByRole($role);
    public function getUsersByRoles($roles);
    public function getUsersByCategory($category);
    public function getUsersByCategories($categories = []);
    public function getPersonalAcademic();
    public function getallstudents($year = null, $showactives = false);
    public function getStudentsPendingByMonitorings($year, $period, $group = null, $area = null, $teacher = null, $subjectNotIn = [54], $statusNotIn = [4, 7, 8, 9, 10]);
    public function getUserByToken($token);
}