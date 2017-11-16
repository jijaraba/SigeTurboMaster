<?php

namespace SigeTurbo\Repositories\Academic;

interface AcademicRepositoryInterface {
    public function all();
    public function find($idacademic);
    public function getPeriodsByYear($year);
    public function getAcademicsByYear($year);
    public function store($data);
    public function update($academic,$data);
    public function destroy($academic);
    public static function getQuerySyntax($objetiluminate);
}