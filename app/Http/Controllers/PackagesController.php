<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use SigeTurbo\Repositories\Package\PackageRepositoryInterface;

class PackagesController extends Controller
{
    /**
     * @var PackageRepositoryInterface
     */
    private $packageRepository;

    /**
     * PackagesController constructor.
     * @param PackageRepositoryInterface $packageRepository
     */
    public function __construct(PackageRepositoryInterface $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /finalcials/packages
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //Search
        $search = [];
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
        $perPage = 10;
        $packages = $this->packageRepository->getPackages($search);
        $paginator = new LengthAwarePaginator(
            $packages->forPage($page, $perPage), $packages->count(), $perPage, $page
        );
        $paginator->setPath('financials/packages');
        return view('packages.index')
            ->withPackages($paginator)
            ->withSearch($search)
            ->withView($view)
            ->withSort($sort)
            ->withOrder($order);
    }


    /**
     * Create Payments For Families
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('packages.create');
    }

    /**
     * Display a listing of the resource.
     * GET /packages
     * @param Request $request
     * @return Response
     */
    public function getPackagesByConcept(Request $request)
    {
        return response()->json($this->packageRepository->all($request['concept']));
    }


}
