<?php

namespace SigeTurbo\Repositories\Package;

interface PackageRepositoryInterface
{
    public function all($concept);
    public function find($package);
    public function getPackages($search);
}