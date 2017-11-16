<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;

use SigeTurbo\Http\Requests;
use SigeTurbo\Repositories\Inventorytype\InventorytypeRepositoryInterface;

class InventorytypesController extends Controller
{
    /**
     * @var InventorytypeRepositoryInterface
     */
    private $inventorytypeRepository;

    /**
     * InventorytypesController constructor.
     * @param InventorytypeRepositoryInterface $inventorytypeRepository
     */
    public function __construct(InventorytypeRepositoryInterface $inventorytypeRepository)
    {
        $this->inventorytypeRepository = $inventorytypeRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /inventorytypes
     * @return Response
     */
    public function index()
    {
        return response()->json($this->inventorytypeRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /inventorytypes/{idinventorytype}
     * @param  int  $inventorytype
     * @return Response
     */
    public function show($inventorytype)
    {
        return response()->json($this->inventortypeRepository->find($inventorytype));
    }
}
