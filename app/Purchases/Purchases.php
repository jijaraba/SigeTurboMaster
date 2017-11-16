<?php namespace SigeTurbo\Purchases;

use Illuminate\Support\Facades\DB;

class Purchases {


    /**
     * Get Discount
     * @return mixed
     */
    public static function getDiscounts()
    {
        return DB::SELECT('
          SELECT
            SUM(total) AS total, SUM(discount) AS discount
          FROM
            (SELECT
              purchases.idpurchase,SUM(total) AS total,(SUM(total) - (SUM(total) * discount)) AS discount
            FROM
              details
              INNER JOIN products ON products.idproduct = details.idproduct
              INNER JOIN purchases ON purchases.idpurchase = details.idpurchase
            GROUP BY purchases.idpurchase) AS purchases');
    }

}