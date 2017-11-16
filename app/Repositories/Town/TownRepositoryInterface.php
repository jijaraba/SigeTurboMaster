<?php

namespace SigeTurbo\Repositories\Town;

interface TownRepositoryInterface {
    public function all();
    public function find($idtown);
    public function whereArea($filter);
}