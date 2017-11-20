<?php

namespace SigeTurbo\Repositories\Permission;

interface PermissionRepositoryInterface {
    public function all();
    public function find($permission);
    public function store($data);
    public function update($permission, $data);
}