<?php

namespace SigeTurbo\Repositories\Contract;

interface ContractRepositoryInterface {
    public function all();
    public function find($idcontract);
    public function store($data);
    public function update($contract,$data);
    public function destroy($contract);
    public function getContractsByYearAndPeriod($idyear,$idperiod);
    public function getContractsByParams($idyear,$idperiod = null,$idgroup = null,$idsubject = null,$idnivel = null,$iduser = null);
}