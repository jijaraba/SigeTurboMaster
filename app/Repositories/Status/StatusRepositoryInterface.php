<?php

namespace SigeTurbo\Repositories\Status;

interface StatusRepositoryInterface {
    public function all();
    public function find($idstatus);
}