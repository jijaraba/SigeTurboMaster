<?php

namespace SigeTurbo\Repositories\Vehicle;

interface VehicleRepositoryInterface {
    public function all();
    public function find($vehicleId);
    public function update($vehicle,$data);
    public function store($data);
    public function destroy($vehicle);
}