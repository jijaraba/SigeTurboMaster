<?php

namespace SigeTurbo\Repositories\Group;

interface GroupRepositoryInterface {
    public function all();
    public function find($idgroup);
    public static function getGroups($year = 1995, $period = 1, $user = null);
    public static function getGroupsForGuest($year = 1995, $period = 1);
    public static function getGroupsForObservator($year = 1995);
    public static function getGroupsByAreaManager($year = 1995, $period = 1, $user = null);
    public static function getLatestGroupByStudent($user);
}