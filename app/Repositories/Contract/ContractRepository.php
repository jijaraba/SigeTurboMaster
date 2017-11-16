<?php

namespace SigeTurbo\Repositories\Contract;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use SigeTurbo\Contract;

class ContractRepository implements ContractRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Contract::select('*')->remember(1440,'Contracts');
    }

    /**
     * Find in Databases
     * @param $idcontract
     * @return mixed
     */
    public function find($idcontract)
    {
        return Contract::find($idcontract);
    }

    /**
     * Save Contract
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Contract::create(array(
            'idyear' => $data['idyear'],
            'idperiod' => $data['idperiod'],
            'idgroup' => $data['idgroup'],
            'idsubject' => $data['idsubject'],
            'idnivel' => $data['idnivel'],
            'iduser' => $data['iduser'],
            'timeintensity' => $data['timeintensity'],
            'created_at' => Carbon::now()
        ));
    }

    /**
     * Update Contract
     * @param $contract
     * @param $data
     * @return mixed
     */
    public function update($contract,$data)
    {
        $contract = Contract::find($contract);
        $contract->fill(array(
            'idyear' => $data['idyear'],
            'idperiod' => $data['idperiod'],
            'idgroup' => $data['idgroup'],
            'idsubject' => $data['idsubject'],
            'idnivel' => $data['idnivel'],
            'iduser' => $data['iduser'],
            'timeintensity' => $data['timeintensity'],
            'updated_at' => Carbon::now()
        ));
        return $contract->save();

    }

    /**
     * Delete Contract
     * @param $contract
     * @return mixed
     * @internal param $data
     */
    public function destroy($contract)
    {
        //Find Contract
        $contract = Contract::find($contract);
        return $contract->delete();
    }

    /**
     * Get Contracts By Year And Period
     * @param $idyear
     * @param $idperiod
     * @return mixed
     */
    public function getContractsByYearAndPeriod($idyear,$idperiod)
    {
        return Contract::select('*')
            ->where('idyear', '=', $idyear)
            ->where('idperiod', '=', $idperiod)
            ->orderBy('idgroup', 'ASC')
            ->orderBy('idsubject', 'ASC')
            ->orderBy('idnivel', 'ASC')
            ->get();
    }

    /**
     * Get Contracts By Parameters
     * @param $idyear
     * @param $idperiod
     * @param $idgroup
     * @param $idsubject
     * @param $idnivel
     * @param $iduser
     * @return mixed
     */
    public function getContractsByParams($idyear,$idperiod = null,$idgroup = null,$idsubject = null,$idnivel = null,$iduser = null)
    {
            $contract = Contract::select('*')
            ->where('idyear', '=',$idyear); 
            if ($idperiod !== null)  $contract->where('idperiod', '=',$idperiod );
            if ($idgroup !== null)  $contract->where('idgroup', '=',$idgroup );
            if ($idsubject !== null)  $contract->where('idsubject', '=',$idsubject );
            if ($idnivel !== null)  $contract->where('idnivel', '=',$idnivel );
            if ($iduser !== null)  $contract->where('iduser', '=',$iduser );
            //dd($this->obtenersintaxisconsulta($contract));
            return $contract 
            ->orderBy('idgroup', 'ASC')
            ->orderBy('idsubject', 'ASC')
            ->orderBy('idnivel', 'ASC')
            ->get();
    }

    // Previamente la consulta nunca debe llegar aqui con un  ->get() pues no daría la Sintaxis de la Consulta
    //https://stackoverflow.com/questions/18236294/how-do-i-get-the-query-builder-to-output-its-raw-sql-query-as-a-string
    private function obtenersintaxisconsulta($objetoiluminate)
    {
        $resultado['Parametros'] = $objetoiluminate->getBindings();
        $query = str_replace(array('%', '?'), array('%%', '%s'), $objetoiluminate->toSql());
        $query = vsprintf($query, $objetoiluminate->getBindings());
        $resultado['Consulta'] = $query;
        return $resultado;
    }

}