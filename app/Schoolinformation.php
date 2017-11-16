<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Schoolinformation extends Model
{

    protected $primaryKey = 'idschoolinformation';
    protected $fillable = ['iduser', 'idcalendar', 'idgrade', 'idenrollmentreason', 'school', 'ubication', 'phone', 'observation','approved', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Table Name
     * @var string
     */
    protected $table = 'schoolinformations';

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('SigeTurbo\User');
    }

    /**
     * @return mixed
     */
    public function calendar()
    {
        return $this->belongsTo('SigeTurbo\Calendar');
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
    public function enrollmentreason()
    {
        return $this->belongsTo('SigeTurbo\Enrollmentreason');
    }

}