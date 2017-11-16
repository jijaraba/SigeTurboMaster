<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Mailer\MailerInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use SigeTurbo\Repositories\Route\RouteRepositoryInterface;
use SigeTurbo\Repositories\Routebyuser\RoutebyuserRepositoryInterface;
use SigeTurbo\Convenyor;
use SigeTurbo\Routebyuser;
use Illuminate\Support\Collection;


class TransportsController extends Controller {

	/**
     * @var RouteRepositoryInterface
     */
    private $routeRepository;

    /**
     * @var RouteRepositoryInterface
     */
    private $routebyuserRepository;

    /**
     * @param RouteRepositoryInterface $routeRepository
     */
    function __construct(RouteRepositoryInterface $routeRepository, RoutebyuserRepositoryInterface $routebyuserRepository)
    {
        $this->routeRepository = $routeRepository;
        $this->routebyuserRepository = $routebyuserRepository;
    }

	/**
	 * Display a listing of the resource.
	 * GET /typeofpromotions
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		//Search
        $search = [
            'lastpage' => false,
            'name' => null,
            'idroute' => null,
            'iduser' => null
        ];

        $index  = null;
        //dd($search);
        if (isset($request['search'])) {
            $search = json_decode($request['search'], true);
            if (isset($search["iduser"])) $index = 'iduser';
            if (isset($search["idroute"])) $index = 'idroute';
            if (isset($search["name"]))  $index = 'name';
        }
        $perPage = 1;
        $routes = ($index !== null) ?   $this->routeRepository->getRoutesByIndexAndValue($index, $search[$index]) : $this->routeRepository->all();
        $page = 1;
        if($search['lastpage']  == true){
            $page = $routes->count() ;
            $search['lastpage'] = false;
        }else $page = LengthAwarePaginator::resolveCurrentPage();
        $paginator = new LengthAwarePaginator( $routes->forPage($page, $perPage), $routes->count(), $perPage, $page );  
        $paginator->setPath('admissions/transports');
        $collection = new Collection($paginator);
        $pagetoarray = ($collection['total'] == null) ? $page : $page-1;
        $idrouteactual = ($collection['total'] == null) ? null : $collection['data'][$pagetoarray]['idroute'];
        $usersbyroute = $this->routebyuserRepository->getUsersByroute($idrouteactual);
        return view('transports.index')
            ->withRoutes($paginator)
            ->withRoutesall($routes)
            ->withSearch($search)
            ->withUsersbyroute($usersbyroute);        
	}
}