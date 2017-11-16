<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Assettype extends Model
{
    protected $primaryKey = 'idassettype';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'assettypes';


    /**
     * @return mixed
     */
    public function assetcategory()
    {
        return $this->hasMany('SigeTurbo\Assetcategory', 'idassettype', 'idassettype');
    }

}
