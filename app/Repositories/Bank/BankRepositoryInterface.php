<?php

namespace SigeTurbo\Repositories\Bank;

interface BankRepositoryInterface
{
    public function all();
    public function find($bank);
}