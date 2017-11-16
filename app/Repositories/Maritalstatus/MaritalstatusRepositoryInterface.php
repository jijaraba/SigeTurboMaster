<?php

namespace SigeTurbo\Repositories\Maritalstatus;

interface MaritalstatusRepositoryInterface {
    public function all();
    public function find($idmaritalstatus);
}