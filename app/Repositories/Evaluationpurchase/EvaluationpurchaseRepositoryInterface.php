<?php
namespace SigeTurbo\Repositories\Evaluationpurchase;

interface EvaluationpurchaseRepositoryInterface
{
    public function all();
    public function find($idevaluationpurchase);
    public function store($data);
    public function getEvaluationByPurchase($purchase);
}