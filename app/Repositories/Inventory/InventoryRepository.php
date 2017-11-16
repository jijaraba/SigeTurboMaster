<?php

namespace SigeTurbo\Repositories\Inventory;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Inventory;

class InventoryRepository implements InventoryRepositoryInterface
{

    /**
     * Get All Inventory
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('inventories', 1440, function () {
            return Inventorytype::select('inventories.*')
                ->get();
        });
    }

    /**
     * Get Inventory by ID
     * @param $inventory
     * @return mixed
     */
    public function find($inventory)
    {
        return Inventory::find($inventory);
    }


    public function store($asset, $data)
    {
        return Inventory::create(array(
            'idasset' => $asset,
            'idubication' => $data['idubication'],
            'idquality' => $data['idquality'],
            'idinventorytype' => $data['inventorytype'],
            'observation' => ($data['observation'] == "") ? NULL : $data['observation'],
            'iduser' => getUser()->iduser,
            "created_by" => getUser()->iduser,
            "updated_by" => getUser()->iduser,
            "verified_by" => getUser()->iduser,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
    }
}