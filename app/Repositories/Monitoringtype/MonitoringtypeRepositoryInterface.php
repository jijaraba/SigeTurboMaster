<?php

namespace SigeTurbo\Repositories\Monitoringtype;

interface MonitoringtypeRepositoryInterface {
    public function all();
    public function find($idmonitoringtype);
    public function store($data);
    public function getIndicators($data);
    public function destroy($monitoringtype);
    public function getMonitoringtypesForChart($data);
    public function getMonitoringtypes($data);
    public function getMonitoringByCategory($data);
}