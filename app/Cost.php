<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $primaryKey = 'idcost';
    protected $fillable = ['idyear', 'idgrade', 'idconcepttype', 'idaccounttype', 'idtransactiontype', 'value', 'created_by', 'updated_by'];
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

    /**
     * @return mixed
     */
    public function concepttype()
    {
        return $this->belongsTo('SigeTurbo\Concepttype');
    }

    /**
     * @return mixed
     */
    public function accounttype()
    {
        return $this->belongsTo('SigeTurbo\Accounttype');
    }

    /**
     * @return mixed
     */
    public function transactiontype()
    {
        return $this->belongsTo('SigeTurbo\Transactiontype');
    }

}
