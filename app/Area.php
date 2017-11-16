<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Area extends Model
{

    protected $primaryKey = 'idarea';
    protected $fillable = ['name', 'prefix', 'description', 'isPrinteable', 'order', 'active'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'areas';

    /**
     * Return all values
     * @return mixed
     */
    public static function allareas()
    {
        return Cache::remember('areas', 1440, function() {
            return Area::all();
        });
    }

    /**
     * @return mixed
     */
    public function subject()
    {
        return $this->hasMany('SigeTurbo\Subject', 'idarea', 'idarea');
    }

    /**
     * @return mixed
     */
    public function areamanager()
    {
        return $this->hasMany('SigeTurbo\Areamanager', 'idarea', 'idarea');
    }

    /**
     * @return mixed
     */
    public function quantitativerecoveryfinalarea()
    {
        return $this->hasMany('SigeTurbo\Quantitativerecoveryfinalarea', 'idarea', 'idarea');
    }

    /**
     * @return mixed
     */
    public function qualitativerecoveryfinalarea()
    {
        return $this->hasMany('SigeTurbo\Qualitativerecoveryfinalarea', 'idarea', 'idarea');
    }

    /**
     * Get Areas By Year and Period and Group and User
     * @param int $year
     * @param int $period
     * @param String $type
     * @return mixed
     */
    public static function getAreasByYearAndPeriod($year = 1995, $period = 1, $type = 'ASC')
    {
        return Static::select('areas.idarea', 'areas.name', 'areas.shortname')
            ->join('subjects', 'subjects.idarea', '=', 'areas.idarea')
            ->join('monitorings', 'monitorings.idsubject', '=', 'subjects.idsubject')
            ->where('monitorings.idyear', '=', $year)
            ->where('monitorings.idperiod', '=', $period)
            ->where('monitorings.idgroup', '>=', 11)
            ->groupBy('areas.idarea')
            ->orderBy('areas.order', $type)
            ->get();
    }

}
