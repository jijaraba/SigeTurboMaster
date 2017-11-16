<?php

namespace SigeTurbo\Repositories\Accounttype;

interface AccounttypeRepositoryInterface
{
    public function all();
    public function find($accounttype);
    public function findAccountByCode($code);
}