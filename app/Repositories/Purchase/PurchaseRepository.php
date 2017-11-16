<?php

namespace SigeTurbo\Repositories\Purchase;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Purchase;

class PurchaseRepository implements PurchaseRepositoryInterface
{

    /**
     * Show All Purchases
     * Return all values
     * @param null $sort
     * @param string $order
     * @param $provider
     * @return mixed
     */
    public function all($sort = null, $order = 'ASC', $provider = null)
    {

            $purchases =  Purchase::select('purchases.*', 'providers.name AS provider', 'statuspurchases.name AS status', DB::raw('SUBSTR(statuspurchases.name,1,1) AS prefix'), 'statuspurchases.idstatuspurchase', DB::raw('CONCAT_WS(CONVERT(" " USING latin1),users.lastname,users.firstname) AS employee'), 'users.photo')
                ->join('providers', function ($join) {
                    $join
                        ->on('providers.idprovider', '=', 'purchases.idprovider');
                })
                ->join('statuspurchases', function ($join) {
                    $join
                        ->on('statuspurchases.idstatuspurchase', '=', 'purchases.idstatuspurchase');
                })
                ->join('users', function ($join) {
                    $join
                        ->on('users.iduser', '=', 'purchases.iduser');
                });
            if ($provider != null){
                $purchases->where('purchases.idprovider','=',$provider);
            }
            switch($sort){
                case 'code':
                    $purchases->orderBy('purchases.code', $order);
                    break;
                case 'status':
                    $purchases->orderBy('purchases.idstatuspurchase', $order);
                    break;
                case 'provider':
                    $purchases->orderBy('purchases.idprovider', $order);
                    break;
                case 'created_at':
                    $purchases->orderBy('purchases.created_at', $order);
                    break;
                default:
                    $purchases->orderBy('purchases.created_at', $order);
            }
            return $purchases->with('details')
                ->get();
    }

    /**
     * Find in Databases
     * @param $idpurchase
     * @return mixed
     */
    public function find($idpurchase)
    {
        return Purchase::find($idpurchase);
    }

    /**
     * Find in Databases
     * @param $idpurchase
     * @return mixed
     */
    public function getPurchase($idpurchase)
    {
        return Purchase::select('purchases.*','providers.name AS provider')
            ->join('providers', function ($join) {
                $join
                    ->on('providers.idprovider', '=', 'purchases.idprovider');
            })
            ->where('purchases.idpurchase','=',$idpurchase)
            ->with('details')
            ->first();
    }

    /**
     * Save Purchase
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Purchase::create([
            'idprovider' => $data['provider'],
            'iduser' => getUser()->iduser,
            'code' => $data['code'],
            'date' => Carbon::now(),
            'leadtime' => $data['leadtime'],
            'discount' => $data['discount'],
            'budget' => $data['budget'],
            'delivery' => Carbon::now()->addDays($data['leadtime']),
            'observation' => $data['observation']
        ]);
    }

    /**
     * Update Purchase
     * @param $idpurchase
     * @param $data
     * @return mixed
     */
    public function update($idpurchase, $data)
    {
        //Find Purchase
        $purchase = Purchase::find($idpurchase);
        $purchase->fill(array(
            'idprovider' => $data['provider'],
            'leadtime' => $data['leadtime'],
            'discount' => $data['discount'],
            'budget' => $data['budget'],
            'delivery' => Carbon::now()->addDays($data['leadtime']),
            'observation' => $data['observation']
        ));
        return $purchase->save();
    }

    /**
     * Update Status Purchase
     * @param $data
     * @return mixed
     */
    public function updateStatus($data)
    {
        //Find Purchase
        $purchase = Purchase::find($data['purchase']);
        $purchase->fill(array(
            'idstatuspurchase' => $data['status']
        ));
        return $purchase->save();
    }

    /**
     * Generate Code
     * @return mixed
     */
    public function generateCode()
    {

        $date = date("Y-m-d");
        return Purchase::select(DB::raw(
            "CASE
		      WHEN MAX(code) IS NULL THEN CONCAT(REPLACE('" . $date . "', '-', ''),'-01')
		      WHEN SUBSTRING_INDEX(MAX(code), '-', -1) <= 8 THEN  CONCAT(REPLACE(`date`, '-', ''),'-0',SUBSTRING_INDEX(MAX(code), '-', -1)+1)
		      ELSE CONCAT(REPLACE(`date`, '-', ''),'-',SUBSTRING_INDEX(MAX(code), '-', -1)+1)
		     END
		     AS code
		    "
        ))
            ->where('date', '=', $date)
            ->first();
    }

}
