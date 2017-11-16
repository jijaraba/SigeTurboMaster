<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Prepaidmedical extends Model
{

	protected $primaryKey = 'idprepaidmedical';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    
    /**
     * Table Name
     * @var string
     */
    protected $table = 'prepaidmedicals';


    /**
     * @return mixed
     */
    public function healthinformation()
    {
        return $this->hasMany('SigeTurbo\Healthinformation', 'idprepaidmedical', 'idprepaidmedical');
    }
}
