<?php

namespace SigeTurbo\Repositories\Monitoring;

interface MonitoringRepositoryInterface {
    public function all();
    public function find($idmonitoring);
    public function store($data);
    public function update($monitoring,$data);
    public function destroy($monitoring);
    public function getMonitoringByUser($data);
    public function globalPerformances($year);
    public function getMonitoringsForParents($year,$period,$group,$user);
    public function getMonitoringsDetailForParents($year,$period,$group,$subject,$nivel,$user);
}