<?php

namespace SigeTurbo\Repositories\Detail;

interface DetailRepositoryInterface
{
    public function all($purchase);
    public function find($iddetail);
    public function store($data);
    public function update($iddetail, $data);
}