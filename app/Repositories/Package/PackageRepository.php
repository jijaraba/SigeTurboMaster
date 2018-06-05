<?php

namespace SigeTurbo\Repositories\Package;

use SigeTurbo\Package;

class PackageRepository implements PackageRepositoryInterface
{

    /**
     * Get Packages By Concept
     * @param $concept
     * @return mixed
     */
    public function all($concept)
    {
        return Package::select('*')
            ->where('idconcepttype', '=', $concept)
            ->get();
    }

    /**
     * Find Package By ID
     * @param $package
     * @return mixed
     */
    public function find($package)
    {
        return Package::find($package);
    }

    /**
     * Get Packages
     * @param $search
     * @return mixed
     */
    public function getPackages($search)
    {
        $packages = Package::select('*');
        //Search
        if ($search !== null) {
            if (isset($search["concepttype"])) {
                $packages
                    ->where('packages.idconcepttype', '=', $search['concepttype']);
            }
        }
        return $packages
            ->get();

    }
}