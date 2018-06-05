<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Accounttype extends Model
{

    const ACCOUNT_CASH_GENERAL = 1;
    const ACCOUNT_BCO_BBVA_CTE = 2;
    const ACCOUNT_BCO_AVVILLAS = 3;
    const ACCOUNT_BCO_BBVA_AHO = 4;
    const ACCOUNT_PENSIONES = 5;
    const ACCOUNT_ING_PENSION = 6;
    const ACCOUNT_MATRICULA = 7;
    const ACCOUNT_ING_MATRICULA = 8;
    const ACCOUNT_DCTOS = 9;
    const ACCOUNT_INTERESES = 10;
    const ACCOUNT_GUIAS = 11;
    const ACCOUNT_SALIDAS = 12;
    const ACCOUNT_LUDOTECA = 13;
    const ACCOUNT_GRADOS = 14;
    const ACCOUNT_AGENDAS = 15;
    const ACCOUNT_OTROS = 16;

    protected $primaryKey = 'idaccounttype';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'accounttypes';

    /**
     * @return mixed
     */
    public function costs()
    {
        return $this->hasMany('SigeTurbo\Cost', 'idaccounttype', 'idaccounttype');
    }

    /**
     * @return mixed
     */
    public function transactions()
    {
        return $this->hasMany('SigeTurbo\Transaction', 'idaccounttype', 'idaccounttype');
    }
}
