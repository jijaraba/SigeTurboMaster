<?php

namespace SigeTurbo\Repositories\Inventorytype;

interface InventorytypeRepositoryInterface
{
    public function all();
    public function find($inventorytype);
    public function getInventoryLatest();
}