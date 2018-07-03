<?php

namespace SigeTurbo\Repositories\Asset;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Asset;

class AssetRepository implements AssetRepositoryInterface
{

    /**
     * Get All Assets
     * @param array $search
     * @param null $sort
     * @param int $ubication
     * @param string $order
     * @return mixed
     */
    public function all($search = [], $sort = null, $ubication = 0, $order = 'asc')
    {
        $assets = Asset::select('assets.*', 'providers.name AS provider', DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),users.lastname,users.firstname) AS responsible"), 'users.photo')
            ->join('providers', function ($join) {
                $join
                    ->on('providers.idprovider', '=', 'assets.idprovider');
            })
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'assets.updated_by');
            });

        if ($ubication != 0) {
            $assets->join('inventories', function ($join) use ($ubication, $search) {
                $join
                    ->on('inventories.idasset', '=', 'assets.idasset')
                    ->where('inventories.idubication', '=', $ubication)
                    ->where('inventories.idinventorytype', '=', $search["inventory"]);
            });
        }

        //Search
        if ($search !== null) {
            if (isset($search["code"])) {
                $assets
                    ->where('assets.code', 'LIKE', "%" . $search['code'] . "%");
            }
            if (isset($search["name"])) {
                $assets
                    ->where('assets.name', 'LIKE', "%" . $search['name'] . "%");
            }
        }

        switch ($sort) {
            case 'code':
                $assets->orderBy('assets.code', $order);
                break;
            case 'provider':
                $assets->orderBy('assets.idprovider', $order);
                break;
            case 'created_at':
                $assets->orderBy('assets.created_at', $order);
                break;
            default:
                $assets->orderBy('assets.code', $order);
        }
        return $assets
            ->with(['inventories' => function ($query) use ($ubication, $search) {
                $query
                    ->where('idinventorytype', $search["inventory"]);
                if ($ubication !== 0) {
                    $query->where('idubication', '=', $ubication);
                }
            }])
            ->get();
    }

    /**
     * Find Asset By ID
     * @param $asset
     * @return mixed
     */
    public function find($asset)
    {
        return Asset::find($asset);
    }

    /**
     * Create Asset
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Asset::create([
            'idassetcategory' => $data['assetcategory'],
            'idprovider' => $data['provider'],
            'code' => $data['code'],
            'name' => $data['name'],
            'manufacturer' => $data['manufacturer'],
            'model' => $data['model'],
            'serial' => $data['serial'],
            'description' => $data['description'],
            'cost' => $data['cost'],
            'acquired' => $data['acquired'],
            'created_by' => getUser()->iduser,
            'updated_by' => getUser()->iduser,
        ]);
    }

    /**
     * Uodate Asset
     * @param $asset
     * @param $data
     * @return mixed
     */
    public function update($asset, $data)
    {
        //Find Asset
        $asset = Asset::find($asset);
        $asset->fill(array(
            'idassetcategory' => $data['assetcategory'],
            'idprovider' => $data['provider'],
            'code' => $data['code'],
            'name' => $data['name'],
            'manufacturer' => $data['manufacturer'],
            'model' => $data['model'],
            'serial' => $data['serial'],
            'description' => $data['description'],
            'cost' => $data['cost'],
            'acquired' => $data['acquired'],
            'updated_by' => getUser()->iduser
        ));
        return $asset->save();
    }

    /**
     * @param $idasset
     */
    public function destroy($idasset)
    {
        // TODO: Implement destroy() method.
    }

    /**
     * Get Asset With Ubication
     * @param $code
     * @return mixed
     */
    public function getAssetWithUbicationByCode($code)
    {
        return Asset::select('assets.*', 'ubications.name AS ubication', DB::raw('CONCAT_WS(CONVERT(" " USING latin1),users.lastname,users.firstname) AS responsible'), 'users.photo')
            ->join('inventories', function ($join) {
                $join
                    ->on('inventories.idasset', '=', 'assets.idasset')
                    ->where('inventories.idinventorytype', '=', 4);
            })
            ->join('ubications', function ($join) {
                $join
                    ->on('ubications.idubication', '=', 'inventories.idubication');
            })
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'inventories.iduser');
            })
            ->where('assets.code', '=', $code)
            ->first();
    }

    /**
     * Get Asset By Code
     * @param $code
     * @return mixed
     */
    public function getAssetByCode($code)
    {
        return Asset::select('assets.*')
            ->where('assets.code', '=', $code)
            ->first();
    }

    /**
     * @param $asset
     * @return mixed
     */
    public function setVerified($asset)
    {
        //Find Asset
        $asset = Asset::find($asset);
        $asset->fill(array(
            'verified' => 'Y',
            'verified_by' => getUser()->iduser,
        ));
        return $asset->save();
    }
}