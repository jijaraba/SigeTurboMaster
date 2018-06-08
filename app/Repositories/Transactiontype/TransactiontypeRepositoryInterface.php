<?php

namespace SigeTurbo\Repositories\Transactiontype;

interface TransactiontypeRepositoryInterface
{
    public function all();
    public function find($transactiontype);
}