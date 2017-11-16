<?php

namespace SigeTurbo\Repositories\Healthinformation;

interface HealthinformationRepositoryInterface {
    public function all();
    public function find($healthinformation);
    public function store($data);
    public function update($healthinformation, $data);
}