<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Events\Stream;
use SigeTurbo\Http\Requests;
use SigeTurbo\Http\Requests\AssetRequest;
use SigeTurbo\Repositories\Asset\AssetRepositoryInterface;
use SigeTurbo\Repositories\Assetcategory\AssetcategoryRepositoryInterface;
use SigeTurbo\Repositories\Inventorytype\InventorytypeRepositoryInterface;
use SigeTurbo\Repositories\Provider\ProviderRepositoryInterface;
use SigeTurbo\Repositories\Quality\QualityRepositoryInterface;
use SigeTurbo\Repositories\User\UserRepositoryInterface;
use SigeTurbo\Ubication;
use SigeTurbo\User;

class AssetsController extends Controller
{
    /**
     * @var AssetRepositoryInterface
     */
    private $assetRepository;
    /**
     * @var QualityRepositoryInterface
     */
    private $qualityRepository;
    /**
     * @var ProviderRepositoryInterface
     */
    private $providerRepository;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var AssetcategoryRepositoryInterface
     */
    private $assetcategoryRepository;
    /**
     * @var InventorytypeRepositoryInterface
     */
    private $inventorytypeRepository;

    /**
     * AssetsController constructor.
     * @param AssetRepositoryInterface $assetRepository
     * @param QualityRepositoryInterface $qualityRepository
     * @param ProviderRepositoryInterface $providerRepository
     * @param UserRepositoryInterface $userRepository
     * @param AssetcategoryRepositoryInterface $assetcategoryRepository
     * @param InventorytypeRepositoryInterface $inventorytypeRepository
     */
    public function __construct(AssetRepositoryInterface $assetRepository,
                                QualityRepositoryInterface $qualityRepository,
                                ProviderRepositoryInterface $providerRepository,
                                UserRepositoryInterface $userRepository,
                                AssetcategoryRepositoryInterface $assetcategoryRepository,
                                InventorytypeRepositoryInterface $inventorytypeRepository)
    {
        $this->assetRepository = $assetRepository;
        $this->qualityRepository = $qualityRepository;
        $this->providerRepository = $providerRepository;
        $this->userRepository = $userRepository;
        $this->assetcategoryRepository = $assetcategoryRepository;
        $this->inventorytypeRepository = $inventorytypeRepository;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //Ubication
        $ubication = 0;

        //Search
        $search = [
            'ubication' => 0,
            'inventory' => $this->inventorytypeRepository->getInventoryLatest()->idinventorytype
        ];
        if (isset($request['search'])) {
            $search = json_decode($request['search'], true);
            if (isset($search["ubication"])) {
                $ubication = $search["ubication"];
            }
        }

        //Sort
        $sort = 'code';
        if (isset($request['sort'])) {
            $sort = $request['sort'];
        }

        //View
        $view = 'photo';
        if (isset($request['view'])) {
            $view = $request['view'];
        }

        //Order
        $order = 'asc';
        if (isset($request['order'])) {
            $order = $request['order'];
        }

        //Page
        if (!isset($request['page'])) {
            $request['page'] = 1;
        }

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;
        $assets = $this->assetRepository->all($search, $sort, $ubication, strtoupper($order));
        $paginator = new LengthAwarePaginator(
            $assets->forPage($page, $perPage), $assets->count(), $perPage, $page
        );
        $paginator->setPath('resources/assets');
        return view('assets.index')
            ->withAssets($paginator)
            ->withSearch($search)
            ->withSort($sort)
            ->withView($view)
            ->withOrder($order);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('assets.create')
            ->withProviders($this->providerRepository->all()->lists('name', 'idprovider'))
            ->withAssetcategories($this->assetcategoryRepository->all()->lists('name', 'idassetcategory'))
            ->withSearch($request['search'])
            ->withSort($request['sort'])
            ->withOrder($request['order'])
            ->withPage($request['page'])
            ->withUbication($request['ubication']);
    }


    /**
     * Create Asset
     * @param AssetRequest $request
     * @return mixed
     */
    public function store(AssetRequest $request)
    {
        //Save Asset
        $asset = $this->assetRepository->store($request);

        $data = [];
        if ($asset) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['asset'] = $asset;
            //Delete Cache
            Cache::forget('assets');
            //Stream
            event(new Stream(['description' => "ingresó el activo " . $request["name"]]));
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int $asset
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($asset, Request $request)
    {
        return view('assets.edit')
            ->withAsset($this->assetRepository->find($asset))
            ->withProviders($this->providerRepository->all()->lists('name', 'idprovider'))
            ->withAssetcategories($this->assetcategoryRepository->all()->lists('name', 'idassetcategory'))
            ->withSearch($request['search'])
            ->withSort($request['sort'])
            ->withOrder($request['order'])
            ->withPage($request['page'])
            ->withUbication($request['ubication']);
    }


    /**
     * @param $asset
     * @param AssetRequest $request
     * @return mixed
     */
    public function update($asset, AssetRequest $request)
    {
        //Update Asset
        $asset = $this->assetRepository->update($asset, $request);
        $data = [];
        if ($asset) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['observer'] = $asset;
            //Delete Cache
            Cache::forget('assets');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Set Asset Approved
     * @param Request $request
     * @return mixed
     */
    public function setVerified(Request $request)
    {
        //Asset Verified
        $asset = $this->assetRepository->setVerified($request['asset']);
        $data = [];
        if ($asset) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            $data['task'] = $asset;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }

        return response()->json($data);
    }
}
