<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;

class VouchersController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /vouchers
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //Search
        $search = [
            'year' => $this->yearRepository->getCurrentYear()->idyear,
            'pending' => 1
        ];
        if (isset($request['search'])) {
            $search = json_decode($request['search'], true);
        }

        //View
        $view = 'list';
        if (isset($request['view'])) {
            $view = $request['view'];
        }

        //Sort
        $sort = 'code';
        if (isset($request['sort'])) {
            $sort = $request['sort'];
        }

        //Order
        $order = 'desc';
        if (isset($request['order'])) {
            $order = $request['order'];
        }

        //Page
        if (!isset($request['page'])) {
            $request['page'] = 1;
        }
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;
        $families = $this->familyRepository->searchFamiliesWithPayments($search["year"], $search, $sort, $order);
        $paginator = new LengthAwarePaginator(
            $families->forPage($page, $perPage), $families->count(), $perPage, $page
        );
        $paginator->setPath('financials/payments');
        return view('payments.index')
            ->withFamilies($paginator)
            ->withSearch($search)
            ->withView($view)
            ->withSort($sort)
            ->withOrder($order)
            ->withServerdate(Carbon::now()->format("Y-m-d"));
    }
}
