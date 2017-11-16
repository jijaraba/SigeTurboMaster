<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Visitortype extends Model
{

    protected $primaryKey = 'idvisitortype';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'visitortypes';

    /**
     * @return mixed
     */
    public function visitors()
    {
        return $this->hasMany('SigeTurbo\Visitor', 'idvisitortype', 'idvisitortype');
    }


}