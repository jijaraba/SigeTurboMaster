<?php

namespace SigeTurbo\Repositories\Descriptivereport;

interface DescriptivereportRepositoryInterface {
    public function all();
    public function find($idsescriptivereport);
    public function store($data);
    public function update($escriptivereport,$data);
    public function destroy($descriptivereport);
}