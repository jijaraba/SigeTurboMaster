<?php

namespace SigeTurbo\Repositories\Preregistration;

interface PreregistrationRepositoryInterface
{
    public function all();
    public function find($idpreregistration);
    public function store($data);
    public function update($idpreregistration,$data);
    public function destroy($idpreregistration);
}