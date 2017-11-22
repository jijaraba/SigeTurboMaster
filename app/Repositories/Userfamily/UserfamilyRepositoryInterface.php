<?php

namespace SigeTurbo\Repositories\Userfamily;

interface UserfamilyRepositoryInterface
{
    public function all();
    public function find($iduserfamily);
    public function store($data);
    public function getUsersByFamily($user);
    public function getMembersFamilyByUser($user);
    public function getFamilies($family = [], $category = [], $group = []);
    public function getFamilyByUser($user);
    public function getFamilyName($user);
    public function getEmailsByFamily($year, $family);
}