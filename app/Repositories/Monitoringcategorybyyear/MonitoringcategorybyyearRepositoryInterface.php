<?php

namespace SigeTurbo\Repositories\Monitoringcategorybyyear;

interface MonitoringcategorybyyearRepositoryInterface {
    public function all();
    public function find($idmonitoringcategorybyyear);
    public function store($data);
    public function update($monitoringcategorybyyear,$data);
    public function destroy($monitoringcategorybyyear);
    public function getMonitoringcategorybyyears($year,$subject);
    public static function getMonitoringcategorybyyearDetail($year,$subject = null);
    public static function getQuerySyntax($objetiluminate);
}