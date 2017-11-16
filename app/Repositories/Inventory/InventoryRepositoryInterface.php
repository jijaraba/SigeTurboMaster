<?php

namespace SigeTurbo\Repositories\Inventory;

interface InventoryRepositoryInterface
{
    public function all();
    public function find($inventory);
    public function store($asset, $data);
}