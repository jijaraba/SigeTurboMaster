<?php

namespace SigeTurbo\Repositories\Inventorytype;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Inventorytype;

class InventorytypeRepository implements InventorytypeRepositoryInterface
{

    /**
     * Get All Inventorytypes
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('inventorytypes', 1440, function () {
            return Inventorytype::select('inventorytypes.*')
                ->orderBy('starts', 'DESC')
                ->get();
        });
    }

    /**
     * Get Inventorytype by ID
     * @param $inventorytype
     * @return mixed
     */
    public function find($inventorytype)
    {
        return Inventorytype::find($inventorytype);
    }

    /**
     * Get Inventory Latest
     * @return mixed
     */
    public function getInventoryLatest()
    {
        return Inventorytype::select("*")
            ->orderBy('starts','DESC')
            ->first();
    }
}