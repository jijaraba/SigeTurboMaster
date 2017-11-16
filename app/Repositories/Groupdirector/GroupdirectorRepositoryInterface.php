<?php

namespace SigeTurbo\Repositories\Groupdirector;

interface GroupdirectorRepositoryInterface {
    public function all();
    public function find($idgroupdirector);
    public function store($data);
    public function update($groupdirector,$data);
    public function destroy($groupdirector);
    public static function getName($year, $group);
    public static function getGroupsDirectorsByYearOrGroups($year, $group = null);
    public static function getGroupDirectorByYearAndUser($year, $iduser);
}