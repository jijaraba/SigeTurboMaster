<?php

namespace SigeTurbo\Repositories\Evaluationpurchase;

use Illuminate\Support\Facades\DB;
use SigeTurbo\Evaluationpurchase;

class EvaluationpurchaseRepository implements EvaluationpurchaseRepositoryInterface
{

    /**
     * Get All Evaluationpurchase
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Evaluationpurchase::all();
    }

    /**
     * Get Evaluationpurchase By ID
     * @param $idevaluationpurchase
     */
    public function find($idevaluationpurchase)
    {
        return Evaluationpurchase::find($idevaluationpurchase);
    }

    /**
     * Save Evaluation Purchase
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Evaluationpurchase::create([
            'idpurchase' => $data['idpurchase'],
            'opportunity' => $data['opportunity'],
            'quality' => $data['quality'],
            'service' => $data['service'],
            'observation' => $data['observation'],
            'total' => $data['total'],
            'created_by' => getUser()->iduser
        ]);
    }

    /**
     * Get Evaluation Purchase By PurchaseID
     * @param $purchase
     */
    public function getEvaluationByPurchase($purchase)
    {
        return Evaluationpurchase::select('*')
            ->where('evaluationpurchases.idpurchase','=',$purchase)
            ->first();
    }
}