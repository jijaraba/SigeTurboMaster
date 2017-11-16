<?php

namespace SigeTurbo\Repositories\Costcenter;

interface CostcenterRepositoryInterface
{
    public function all();
    public function find($costcenter);
    public function findCostcenterByCode($code);
}