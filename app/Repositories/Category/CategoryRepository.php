<?php

namespace SigeTurbo\Repositories\Category;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Category;

class CategoryRepository implements CategoryRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('categories', 1440, function() {
            return Category::all();
        });

    }

    /**
     * Find in Databases
     * @param $idcategory
     * @return mixed
     */
    public function find($idcategory)
    {
        return Category::find($idcategory);
    }

}
