<?php

namespace SigeTurbo\Repositories\Request;

interface RequestRepositoryInterface {
    public function all();
    public function find($idrequest);
    public function store($data);
    public function update($request,$data);
    public function destroy($request);
    public function getRequestsByUsers($user);
}