<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use SigeTurbo\Repositories\Prepaidmedical\PrepaidmedicalRepositoryInterface;

class PrepaidmedicalsController extends Controller
{
    /**
     * @var PrepaidmedicalRepositoryInterface
     */
    private $prepaidmedicalRepository;

    /**
     * PrepaidmedicalsController constructor.
     * @param PrepaidmedicalRepositoryInterface $prepaidmedicalRepository
     */
    public function __construct(PrepaidmedicalRepositoryInterface $prepaidmedicalRepository)
    {
        $this->prepaidmedicalRepository = $prepaidmedicalRepository;
    }

    /**
     * Get All Prepaidmedicals
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->prepaidmedicalRepository->all());
    }

}
