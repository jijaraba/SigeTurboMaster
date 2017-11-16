<?php

namespace SigeTurbo\Repositories\Tasktype;

interface TasktypeRepositoryInterface {
    public function all();
    public function find($idtasktype);
}