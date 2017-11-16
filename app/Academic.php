<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Repositories\Year\YearRepository;

class Academic extends Model
{

    protected $primaryKey = 'idacademic';
    protected $fillable = ['idyear', 'idperiod', 'idcalendar', 'starts', 'ends', 'rating', 'review', 'print'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'academics';


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
    public function calendar()
    {
        return $this->belongsTo('SigeTurbo\Calendar');
    }


    /**
     * Get Current Academic
     * @return mixed
     */
    public static function getCurrentAcademic()
    {
        return static::select('*')
            ->where('starts', '>=', DB::raw('CURDATE()'))
            ->where('ends', '>=', DB::raw('CURDATE()'))
            ->first();
    }

    /**
     * Get Current Academic
     * @return mixed
     */
    public static function getAcademicFirstPeriod()
    {
        $yearRepository = new YearRepository();
        return static::select('*')
            ->where('idyear','=',$yearRepository->getCurrentYear()->idyear)
            ->where('idperiod','=',1)
            ->first();
    }

}