<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use SigeTurbo\Repositories\Medicalinsurance\MedicalinsuranceRepositoryInterface;

class MedicalinsurancesController extends Controller
{
    /**
     * @var MedicalinsuranceRepositoryInterface
     */
    private $medicalinsuranceRepository;

    /**
     * MedicalinsurancesController constructor.
     * @param MedicalinsuranceRepositoryInterface $medicalinsuranceRepository
     */
    public function __construct(MedicalinsuranceRepositoryInterface $medicalinsuranceRepository)
    {
        $this->medicalinsuranceRepository = $medicalinsuranceRepository;
    }

    /**
     * Get All Medicalinsurances
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->medicalinsuranceRepository->all());
    }
}
