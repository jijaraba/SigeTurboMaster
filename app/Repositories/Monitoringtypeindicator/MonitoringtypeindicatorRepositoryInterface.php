<?php

namespace SigeTurbo\Repositories\Monitoringtypeindicator;

interface MonitoringtypeindicatorRepositoryInterface {
    public function all();
    public function find($idmonitoringtypeindicator);
    public function store($data);
    public function destroy($monitoringtypeindicator);
}