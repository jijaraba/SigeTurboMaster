<?php

namespace SigeTurbo\Repositories\Report;

interface ReportRepositoryInterface
{
    public function all();
    public function find($idreport);
    public function store($data);
    public function getReportByStudent($year,$period,$user,$type);
}