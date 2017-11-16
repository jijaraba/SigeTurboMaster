<?php

namespace SigeTurbo\Repositories\Schoolinformation;

interface SchoolinformationRepositoryInterface {
    public function all();
    public function find($schoolinformation);
    public function store($data);
    public function update($schoolinformation, $data);
}