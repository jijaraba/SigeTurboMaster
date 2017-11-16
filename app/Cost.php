<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $primaryKey = 'idcost';
    protected $fillable = ['idyear', 'idgrade', 'enrollment', 'enrollment_expired', 'pension_discount', 'pension_normal', 'pension_expired', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'costs';

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
    public function grade()
    {
        return $this->belongsTo('SigeTurbo\Grade');
    }
}
