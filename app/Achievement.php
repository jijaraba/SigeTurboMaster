<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{

    protected $primaryKey = 'idachievement';
    protected $fillable = ['idyear', 'idperiod', 'idgrade', 'idsubject', 'idnivel', 'achievement'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'achievements';


    /**
     * @return mixed
     */
    public function year()
    {
        return $this->belongsTo('SigeTurbo\Year');
    }

    /**
     * @return mixed
     */
    public function period()
    {
        return $this->belongsTo('SigeTurbo\Period');
    }

    /**
     * @return mixed
     */
    public function grade()
    {
        return $this->belongsTo('SigeTurbo\Grade');
    }

    /**
     * @return mixed
     */
    public function subject()
    {
        return $this->belongsTo('SigeTurbo\Subject');
    }

    /**
     * @return mixed
     */
    public function nivel()
    {
        return $this->belongsTo('SigeTurbo\Nivel');
    }

    /**
     * @return mixed
     */
    public function indicators()
    {
        return $this->hasMany('SigeTurbo\Indicator', 'idachievement', 'idachievement')
            ->select("indicators.*", 'indicatorcategories.name AS category', 'indicatorcategories.prefix AS category_prefix')
            ->join('indicatorcategories', function ($join) {
                $join->on('indicatorcategories.idindicatorcategory', '=', 'indicators.idindicatorcategory');
            });
    }

}