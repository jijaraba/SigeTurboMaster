<?php

namespace SigeTurbo\Repositories\Consent;

interface ConsentRepositoryInterface {
    public function all();
    public function find($idconsent);
    public function store($data);
    public function update($consent,$data);
    public function destroy($consent);
    public function getConsentsByUsers($user);
}