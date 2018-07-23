<?php

namespace SigeTurbo\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Http\Requests;
use SigeTurbo\Http\Controllers\Controller;
use SigeTurbo\Http\Requests\InventoryRequest;
use SigeTurbo\Repositories\Asset\AssetRepositoryInterface;
use SigeTurbo\Repositories\Inventory\InventoryRepositoryInterface;
use SigeTurbo\Repositories\Inventorytype\InventorytypeRepositoryInterface;
use SigeTurbo\Repositories\Quality\QualityRepositoryInterface;
use SigeTurbo\Repositories\Ubication\UbicationRepositoryInterface;

class InventoriesController extends Controller
{
    /**
     * @var AssetRepositoryInterface
     */
    private $assetRepository;
    /**
     * @var InventorytypeRepositoryInterface
     */
    private $inventorytypeRepository;
    /**
     * @var UbicationRepositoryInterface
     */
    private $ubicationRepository;
    /**
     * @var QualityRepositoryInterface
     */
    private $qualityRepository;
    /**
     * @var InventoryRepositoryInterface
     */
    private $inventoryRepository;

    /**
     * InventoriesController constructor.
     * @param AssetRepositoryInterface $assetRepository
     * @param InventorytypeRepositoryInterface $inventorytypeRepository
     * @param UbicationRepositoryInterface $ubicationRepository
     * @param QualityRepositoryInterface $qualityRepository
     * @param InventoryRepositoryInterface $inventoryRepository
     */
    public function __construct(AssetRepositoryInterface $assetRepository,
                                InventorytypeRepositoryInterface $inventorytypeRepository,
                                UbicationRepositoryInterface $ubicationRepository,
                                QualityRepositoryInterface $qualityRepository,
                                InventoryRepositoryInterface $inventoryRepository)
    {
        $this->assetRepository = $assetRepository;
        $this->inventorytypeRepository = $inventorytypeRepository;
        $this->ubicationRepository = $ubicationRepository;
        $this->qualityRepository = $qualityRepository;
        $this->inventoryRepository = $inventoryRepository;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = [];
        return view('inventories.index')
            ->withSearch($search)
            ->withInventorytype($this->inventorytypeRepository->getInventoryLatest())
            ->withUbications($this->ubicationRepository->all()->pluck('codes', 'idubication'))
            ->withQualities($this->qualityRepository->all()->pluck('name', 'idquality'));
    }


    /**
     * Verified Code
     * @param $code
     * @return mixed
     */
    public function verify($code)
    {
        $asset = $this->assetRepository->getAssetWithUbicationByCode($code);
        return view('inventories.verify')
            ->withAsset($asset)
            ->withCode($code);
    }


    /**
     * Create Inventory
     * @param InventoryRequest $request
     * @return
     */
    public function inventory(InventoryRequest $request)
    {

        $codesWrong = [];
        DB::beginTransaction();
        try {
            //Verify Asset
            $codes = explode(",", $request["code"]);
            foreach ($codes as $code) {
                $asset = $this->assetRepository->getAssetByCode((int)$code);
                if ($asset) {
                    $this->inventoryRepository->store($asset->idasset, $request);
                } else {
                    array_push($codesWrong, $code);
                }
            }

            if (count($codesWrong) == 0) {
                DB::commit();
                //Delete Cache
                Cache::forget('inventories');
                return redirect()
                    ->route('resources.inventories.index')
                    ->withInput()
                    ->withSuccess(Lang::get('sige.VerifyAssetSuccess'));
            } else {
                throw new Exception;
            }


        } catch (Exception $e) {
            DB::rollback();
            //Delete Cache
            Cache::forget('inventories');
            return redirect()
                ->back()
                ->withInput()
                ->withNotice(Lang::get('sige.VerifyAssetWrong'))
                ->withWrong($codesWrong);
            throw $e;
        }


    }

}
