<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Http\Requests\ProviderRequest;
use SigeTurbo\Repositories\Provider\ProviderRepositoryInterface;

class ProvidersController extends Controller
{
    /**
     * @var ProviderRepositoryInterface
     */
    private $providerRepository;

    /**
     * ProvidersController constructor.
     * @param ProviderRepositoryInterface $providerRepository
     */
    public function __construct(ProviderRepositoryInterface $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /providers
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        //Search
        $search = null;
        if (isset($request['search'])) {
            $search = $request['search'];
        }

        //View
        $view = 'list';
        if (isset($request['view'])) {
            $view = $request['view'];
        }

        //Name
        $sort = 'date';
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
        $perPage = 15;
        $providers =  $this->providerRepository->all($search, $sort, strtoupper($order));
        $paginator = new LengthAwarePaginator(
            $providers->forPage($page, $perPage), $providers->count(), $perPage, $page
        );
        $paginator->setPath('resources/providers');
        return view('providers.index')
            ->withProviders($paginator)
            ->withSearch($search)
            ->withView($view)
            ->withSort($sort)
            ->withOrder($order);
    }

    /**
     * Display the specified resource.
     * GET /providers/{idprovider}
     * @param  int $idprovider
     * @return Response
     */
    public function show($idprovider)
    {
        return response()->json($this->providerRepository->find($idprovider));
    }

    /**
     * Edit Provider
     * @param $provider
     * @param Request $request
     * @return Response
     */
    public function edit($provider, Request $request){
        return view('providers.edit')
            ->withProvider($this->providerRepository->find($provider))
            ->withSort($request['sort'])
            ->withOrder($request['order'])
            ->withPage($request['page']);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $idprovider
     * @param ProviderRequest $request
     * @return Response
     */
    public function update($idprovider,ProviderRequest $request)
    {
        //Update Provider
        $provider = $this->providerRepository->update($idprovider, $request);

        $data = [];
        if ($provider) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            //Delete Cache
            Cache::forget('providers');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

}