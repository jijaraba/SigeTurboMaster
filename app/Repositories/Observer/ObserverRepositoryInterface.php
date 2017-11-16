<?php

namespace SigeTurbo\Repositories\Observer;

interface ObserverRepositoryInterface {
    public function all();
    public function find($idobserver);
    public function store($data);
    public function update($observer,$data);
    public function getObservers($data);
}