<?php

namespace SigeTurbo\Repositories\Detail;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Detail;

class DetailRepository implements DetailRepositoryInterface
{

    /**
     * Return all values
     * @param $purchase
     * @return mixed
     */
    public function all($purchase)
    {
        return Cache::remember('details' . $purchase, 1440, function () use ($purchase) {
            return Detail::select('details.*', 'products.code', 'products.name AS product', 'products.unit', 'products.vat')
                ->join('products', function ($join) {
                    $join
                        ->on('products.idproduct', '=', 'details.idproduct');
                })
                ->where('idpurchase', '=', $purchase)
                ->get();
        });

    }

    /**
     * Find in Databases
     * @param $iddetail
     * @return mixed
     */
    public function find($iddetail)
    {
        return Detail::find($iddetail);
    }

    /**
     * Save Detail
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Detail::create([
            'idpurchase' => $data['purchase'],
            'idproduct' => $data['product'],
            'quantity' => $data['quantity'],
            'cost' => $data['cost'],
            'total' => $data['cost'] * $data['quantity'],
        ]);
    }


    /**
     * Update Detail
     * @param $iddetail
     * @param $data
     * @return mixed
     */
    public function update($iddetail, $data)
    {
        //Find Detail
        $detail = Detail::find($iddetail);
        $detail->fill([
            'quantity' => $data['quantity'],
            'cost' => $data['cost'],
            'total' => $data['cost'] * $data['quantity']
        ]);
        return $detail->save();
    }
}
