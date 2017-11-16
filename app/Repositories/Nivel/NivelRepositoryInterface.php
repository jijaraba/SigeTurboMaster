<?php

namespace SigeTurbo\Repositories\Nivel;

interface NivelRepositoryInterface {
    public function all();
    public function find($idnivel);
    public function getNivels($year = 1995, $period = 1, $group = 1, $subject = 1, $user = null);
    public function getNivelsByArea($year = 1995, $period = 1, $group = 1, $subject = 1, $user = null);
    public function getNivelsBySubject($subject = 1);
}