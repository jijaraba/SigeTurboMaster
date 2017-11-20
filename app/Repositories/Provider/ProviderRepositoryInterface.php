<?php

namespace SigeTurbo\Repositories\Provider;

interface ProviderRepositoryInterface
{
    public function all($search = null, $sort = null, $order = 'ASC');
    public function find($idprovider);
    public function store($data);
    public function update($idprovider,$data);
    public function destroy($idprovider);
}