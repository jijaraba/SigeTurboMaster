<?php

namespace SigeTurbo\Repositories\Bloodtype;

interface BloodtypeRepositoryInterface
{
    public function all();
    public function find($bloodtype);
}