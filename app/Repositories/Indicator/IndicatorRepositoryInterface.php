<?php

namespace SigeTurbo\Repositories\Indicator;

interface IndicatorRepositoryInterface {
    public function all();
    public function find($idindicator);
    public function storeFortitude($data);
    public function storeRecommendation($data);
    public function updateFortitude($indicator,$data);
    public function updateRecommendation($indicator,$data);
    public function getIndicatorsByGroup($data);
    public function getIndicators($data);
    public function getIndicatorsByConsecutive($data);
    public function getIndicatorsPendingByTeacher($year = 1995, $period = 1, $user);
}