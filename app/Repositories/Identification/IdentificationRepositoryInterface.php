<?php

namespace SigeTurbo\Repositories\Identification;

interface IdentificationRepositoryInterface {
    public function all();
    public function find($identification);
    public function store($data);
    public function update($identification, $data);
}