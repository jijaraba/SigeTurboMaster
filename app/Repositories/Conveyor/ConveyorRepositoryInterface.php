<?php

namespace SigeTurbo\Repositories\Conveyor;

interface ConveyorRepositoryInterface {
    public function all();
    public function find($conveyorId);
    public function store($data);
    public function destroy($conveyor);
}