<?php

namespace SigeTurbo\Repositories\Asset;

interface AssetRepositoryInterface
{
    public function all($search = [], $sort = null, $ubication = 0, $order = 'ASC');
    public function find($asset);
    public function getAssetByCode($code);
    public function getAssetWithUbicationByCode($code);
    public function store($data);
    public function update($idasset,$data);
    public function destroy($idasset);
    public function setVerified($asset);
}