<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Medicalinsurance extends Model
{
    protected $primaryKey = 'idmedicalinsurance';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    
    /**
     * Table Name
     * @var string
     */
    protected $table = 'medicalinsurances';


    /**
     * @return mixed
     */
    public function healthinformation()
    {
        return $this->hasMany('SigeTurbo\Healthinformation', 'idmedicalinsurance', 'idmedicalinsurance');
    }
}
