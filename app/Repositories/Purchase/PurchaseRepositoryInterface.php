<?php

namespace SigeTurbo\Repositories\Purchase;

interface PurchaseRepositoryInterface {
    public function all($sort = null, $order = 'ASC',$provider = null);
    public function find($idpurchase);
    public function getPurchase($idpurchase);
    public function store($data);
    public function update($idpurchase,$data);
    public function updateStatus($data);
    public function generateCode();
}