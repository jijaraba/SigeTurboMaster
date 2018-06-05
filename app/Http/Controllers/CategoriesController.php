<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SigeTurbo\Repositories\Category\CategoryRepositoryInterface;

class CategoriesController extends Controller
{

    /**
     * @param CategoryRepositoryInterface $categoryRepository
     */
    function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /categories
     * @return Response
     */
    public function index()
    {
        return response()->json($this->categoryRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /categories/{idcategory}
     * @param  int $idcategory
     * @return Response
     */
    public function show($idcategory)
    {
        return response()->json($this->categoryRepository->find($idcategory));
    }

    /**
     * Display the specified resource.
     * GET /categories/getcategorycodebyname
     * @param Request $request
     * @return Response
     */
    public function getCategoryCodeByName(Request $request)
    {
        return response()->json($this->categoryRepository->getCategoryCodeByName($request['category']));
    }


}