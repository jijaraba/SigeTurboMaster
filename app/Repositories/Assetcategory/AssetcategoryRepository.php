<?php

namespace SigeTurbo\Repositories\Assetcategory;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Assetcategory;

class AssetcategoryRepository implements AssetcategoryRepositoryInterface
{

    /**
     * Get All Asset Categories
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('assetcategories', 1440, function () {
            return Assetcategory::select('*')
                ->orderBy('name','ASC')
                ->get();
        });
    }

    /**
     * Get Specific Asset
     * @param $assetcategory
     * @return mixed
     */
    public function find($assetcategory)
    {
        return Assetcategory::find($assetcategory);
    }
}