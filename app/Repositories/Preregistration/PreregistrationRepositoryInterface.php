<?php

namespace SigeTurbo\Repositories\Preregistration;

interface PreregistrationRepositoryInterface
{
    public function all();
    public function find($preregistration);
    public function store($data);
    public function updateProfileGeneral($preregistration, $data);
    public function updateProfileMedical($preregistration, $data);
    public function updateProfileAdditional($preregistration, $data);
    public function updateProfileProfession($preregistration, $data);
    public function destroy($preregistration);
    public function getPreregistrationByUser($user);
    public function setPaymentCreated($user);
}