<?php

namespace SigeTurbo\Repositories\Area;

interface AreaRepositoryInterface {
    public function all();
    public function find($idarea);
    public static function getAreasByYear($year);
    public static function getQuerySyntax($objetiluminate);
}