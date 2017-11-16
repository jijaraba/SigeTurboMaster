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
        return $this->hasMany('SigeTurbo\Payment', 'iduser', 'iduser')
            ->select('payments.*',DB::raw('MONTHNAME(payments.realdate) AS month_name'))
            ->orderBy('payments.realdate','DESC')
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
            ->first();
    }
}