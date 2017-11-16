<?php

namespace SigeTurbo\Repositories\Weeklyevaluation;

interface WeeklyevaluationRepositoryInterface {
    public function all($sort = null, $order = 'ASC');
    public function find($idweeklyevaluation);
    public function store($data);
    public function update($weeklyevaluation,$data);
    public function getEvaluations($year = 2015, $sort = 'week', $order = 'ASC');
}