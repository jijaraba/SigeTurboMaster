<?php

namespace SigeTurbo\Repositories\Partial;

interface PartialRepositoryInterface {
    public function all();
    public function find($idpartial);
    public function store($data);
    public function update($partial,$data);
    public function destroy($partial);
}