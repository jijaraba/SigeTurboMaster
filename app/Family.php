<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Family extends Model
{

    protected $primaryKey = 'idfamily';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'families';


    /**
     * @return mixed
     */
    public function users()
    {
        return $this->hasMany('SigeTurbo\Userfamily', 'idfamily', 'idfamily')
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'userfamilies.iduser');
            });
    }

    /**
     * @return mixed
     */
    public function preregistrations()
    {
        return $this->hasMany('SigeTurbo\Preregistration', 'idfamily', 'idfamily');
    }


    /**
     * @return mixed
     */
    public function payments()
    {
        $vouchertype = Vouchertype::INVOICE;
        return $this->hasMany('SigeTurbo\Payment', 'iduser', 'iduser')
            ->select('payments.*', DB::raw('CASE WHEN CURDATE()<= date1 THEN "discount" WHEN CURDATE()> date1 && CURDATE()<= date2 THEN "normal" ELSE "expired" END AS real_method'), DB::raw('MONTHNAME(payments.realdate) AS month_name'), 'receiptpayments.value AS receipt_realvalue', 'receiptpayments.document')
            ->leftJoin(DB::raw("(SELECT idpayment,GROUP_CONCAT(CAST(receipts.document AS CHAR) ORDER BY document SEPARATOR '-') AS document,GROUP_CONCAT(CAST(receiptpayments.value AS CHAR) ORDER BY document SEPARATOR '-') AS partial,SUM(receiptpayments.value) as value
                            FROM receiptpayments WHERE idvouchertype <> $vouchertype INNER JOIN receipts ON receipts.idreceipt = receiptpayments.idreceipt  GROUP BY idpayment) AS receiptpayments"), function ($join) {
                $join->on('receiptpayments.idpayment', '=', 'payments.idpayment');
            })
            ->orderBy('payments.idyear', 'DESC')
            ->orderBy('payments.idpaymenttype', 'DESC')
            ->orderBy('payments.realdate', 'DESC')
            ->limit(20)
            ->with('transactions');
    }

    /**
     * @param $search
     * @return mixed
     */
    public static function searchFamilyByName($search)
    {
        return Static::select('families.idfamily', 'families.name')
            ->where("families.name", 'LIKE', "%$search%")
            ->with('users')
            ->limit(5)
            ->get();
    }
}