<?php

namespace SigeTurbo\Repositories\Product;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Product;

class ProductRepository implements ProductRepositoryInterface
{

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('products', 1440, function () {
            return Product::all();
        });
    }

    /**
     * Find in Databases
     * @param $idproduct
     * @return mixed
     */
    public function find($idproduct)
    {
        return Product::find($idproduct);
    }

    /**
     * @param $code
     */
    public function code($code)
    {
        return Product::select('*')
            ->where('code','=',$code)->first();
    }

}
