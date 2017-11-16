<?php

namespace SigeTurbo\Repositories\Assetcategory;

interface AssetcategoryRepositoryInterface
{
    public function all();
    public function find($assetcategory);
}