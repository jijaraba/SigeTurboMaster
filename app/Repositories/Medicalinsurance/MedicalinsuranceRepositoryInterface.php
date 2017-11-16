<?php

namespace SigeTurbo\Repositories\Medicalinsurance;

interface MedicalinsuranceRepositoryInterface {
    public function all();
    public function find($medicalinsurance);
}