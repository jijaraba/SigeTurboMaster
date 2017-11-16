<?php

namespace SigeTurbo\Repositories\Subject;

interface SubjectRepositoryInterface {
    public function all();
    public function find($idsubject);
    public function getSubjects($year = 1995, $period = 1, $group = null, $user = null, $type = 'ASC');
    public function getSubjectsWithoutPeriod($year = 1995);
    public function getSubjectsByArea($year = 1995, $period = 1, $group = null, $user = null, $type = 'ASC');
    public static function getSubjectsWithAreasAndNivels($subject = null);
    public static function getSubjectsByYear($year);
    public static function getQuerySyntax($objetiluminate);
}