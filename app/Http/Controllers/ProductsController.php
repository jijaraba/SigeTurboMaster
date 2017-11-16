<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SigeTurbo\Repositories\Product\ProductRepositoryInterface;

class ProductsController extends Controller
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @param ProductRepositoryInterface $productRepository
     */
    function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    /**
     * Display a listing of the resource.
     * GET /products
     * @return Response
     */
    public function index()
    {
        return response()->json($this->productRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /products/{idproduct}
     * @param  int $idproduct
     * @return Response
     */
    public function show($idproduct)
    {
        return response()->json($this->productRepository->find($idproduct));
    }


    /**
     * Search By Code
     * @param Request $request
     * @return mixed
     */
    public function searchbycode(Request $request)
    {
        return response()->json($this->productRepository->code($request['code']));
    }

}