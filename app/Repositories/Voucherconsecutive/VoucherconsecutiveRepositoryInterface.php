<?php

namespace SigeTurbo\Repositories\Voucherconsecutive;

interface VoucherconsecutiveRepositoryInterface
{
    public function all();
    public function find($voucherconsecutive);
    public function getCurrentDocumentByType($type);
    public function getCurrentDocumentByVoucher($voucher);
    public function updateDocumentByID($document);
    public function getVoucherConsecutiveByName($name);
    public function getVoucherConsecutiveByCode($code);
}