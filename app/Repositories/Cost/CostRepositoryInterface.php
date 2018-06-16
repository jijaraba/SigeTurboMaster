<?php

namespace SigeTurbo\Repositories\Cost;

interface CostRepositoryInterface
{
    public function all();
    public function find($cost);
    public function costByGroup($year, $group);
    public function getCostsByPackageAndCategory($year, $grade, $type, $package, $category);
}