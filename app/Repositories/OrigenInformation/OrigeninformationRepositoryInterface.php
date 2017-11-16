<?php

namespace SigeTurbo\Repositories\Origeninformation;

interface OrigeninformationRepositoryInterface{
    public function all();
    public function find($origeninformation);
    public function store($data);
    public function update($origeninformation, $data);
}