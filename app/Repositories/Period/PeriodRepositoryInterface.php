<?php

namespace SigeTurbo\Repositories\Period;

interface PeriodRepositoryInterface {
    public function all();
    public function find($idperiod);
    public function getPeriodsByYear($year = 1995, $user = null);
    public function getCurrentPeriod($calendar = 2);
}