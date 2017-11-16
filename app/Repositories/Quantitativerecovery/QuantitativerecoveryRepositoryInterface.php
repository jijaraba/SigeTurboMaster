<?php

namespace SigeTurbo\Repositories\Quantitativerecovery;

interface QuantitativerecoveryRepositoryInterface {
    public function all();
    public function find($idquantitativerecovery);
    public function store($data);
    public function update($quantitativerecovery,$data);
    public function destroy($quantitativerecovery);
    public function getRecoveryByUser($data);
}