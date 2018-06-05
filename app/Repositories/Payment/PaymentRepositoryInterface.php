<?php

namespace SigeTurbo\Repositories\Payment;

interface PaymentRepositoryInterface
{
    public function all();
    public function find($payment);
    public function update($idpayment, $data);
    public function updatePaymentShort($data);
    public function updatePaymentRejected($data);
    public function getPaymentByTransactionID($transactionID);
    public function getPaymentByID($payment);
    public function getPaymentsByUser($user, $pending = false, $sort = null, $order = 'ASC', $excludeCurrentMonth = false);
    public function getPaymentsPendingByUser($user, $pending = false, $sort = null, $order = 'ASC', $excludeCurrentMonth = false);
    public function getPaymentsByUserWithTransactions($user);
    public function getPaymentsPending();
    public function setPaymentMethod($data);
    public function setPaymentAgreement($data);
    public function setPaymentIndividual($family, $data);
    public function setPaymentStatus($payment, $data, $dataCPV);
    public function verifyPaymentPending($payment, $dataCPV);
    public function getPaymentsByYearAndMonth($year, $month);
    public function getPaymentsApprovedByYearAndMonth($year, $month);
    public function getPaymentsVirtualApprovedByYearAndMonth($year, $month);
    public function configDataPayment($year, $group, $cost, $student, $config = null);
}