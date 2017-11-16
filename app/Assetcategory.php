<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Assetcategory extends Model
{
    protected $primaryKey = 'idassetcategory';
    protected $fillable = ['idassettype','name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'assetcategories';

    /**
     * @return mixed
     */
    public function assettype()
    {
        return $this->belongsTo('SigeTurbo\Assettype');
    }
}
