<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Indicatorcategory extends Model
{

    const INDICATORCATEGORY_GENERAL = 1;
    const INDICATORCATEGORY_DEEPENING = 2;
    const INDICATORCATEGORY_RELAXATION = 3;

    protected $primaryKey = 'idindicatorcategory';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'indicatorcategories';


    /**
     * @return mixed
     */
    public function indicator()
    {
        return $this->hasMany('SigeTurbo\Indicator', 'idindicatorcategory', 'idindicatorcategory');
    }

}