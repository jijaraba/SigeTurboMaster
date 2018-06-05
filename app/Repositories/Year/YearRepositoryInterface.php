<?php

namespace SigeTurbo\Repositories\Year;

interface YearRepositoryInterface
{
    public function all();
    public function find($idperiod);
    public static function getCurrentYear($calendar = 2);
    public function getCurrentPreregistration($calendar = 2);
}