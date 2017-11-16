<?php

namespace SigeTurbo\Repositories\Areamanager;

interface AreamanagerRepositoryInterface {
    public function all();
    public function find($idareamanager);
    public function store($data);
    public function update($areamanager,$data);
    public function destroy($areamanager);
    public static function getAreaManagersByYearOrGroups($year, $group = null);
    public static function getAreaManagerByYearAndUser($year, $iduser);
}