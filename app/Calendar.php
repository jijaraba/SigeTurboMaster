<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{

    protected $primaryKey = 'idcalendar';
    protected $fillable = ['name', 'active'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'calendars';

    /**
     * @return mixed
     */
    public function academics()
    {
        return $this->hasMany('SigeTurbo\Academic', 'idcalendar', 'idcalendar');
    }

    /**
     * @return mixed
     */
    public function schoolinformations()
    {
        return $this->hasMany('SigeTurbo\Schoolinformation', 'idcalendar', 'idcalendar');
    }

}
