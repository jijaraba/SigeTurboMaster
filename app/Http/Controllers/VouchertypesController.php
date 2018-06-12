<?php

namespace SigeTurbo\Http\Controllers;

use SigeTurbo\Repositories\Vouchertype\VouchertypeRepositoryInterface;

class VouchertypesController extends Controller
{
    /**
     * @var VouchertypeRepositoryInterface
     */
    private $vouchertypeRepository;

    /**
     * VouchertypesController constructor.
     * @param VouchertypeRepositoryInterface $vouchertypeRepository
     */
    public function __construct(VouchertypeRepositoryInterface $vouchertypeRepository)
    {
        $this->vouchertypeRepository = $vouchertypeRepository;
    }

    /**
     * Get All Voucher Types
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVouchertypes()
    {
        return response()->json($this->vouchertypeRepository->all());
    }
}
