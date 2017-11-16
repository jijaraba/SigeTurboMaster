<?php

namespace SigeTurbo\Repositories\Family;

interface FamilyRepositoryInterface
{
    public function all();
    public function find($iduserfamily);
    public function store($data);
    public function searchFamilyByName($search);
    public function searchFamiliesWithPayments($year, $search, $sort, $order);
    public function searchFamilies($year);
    public static function obtenersintaxisconsulta($objetoiluminate);
}