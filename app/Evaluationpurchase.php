<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Evaluationpurchase extends Model
{
    protected $primaryKey = 'idevaluationpurchase';
    protected $fillable = ['idpurchase', 'opportunity', 'quality', 'service', 'total', 'observation', 'created_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'evaluationpurchases';

    /**
     * @return mixed
     */
    public function purchase()
    {
        return $this->hasMany('SigeTurbo\Purchase', 'idpurchase', 'idpurchase');
    }
}