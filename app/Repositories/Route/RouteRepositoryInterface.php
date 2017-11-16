<?php

namespace SigeTurbo\Repositories\Route;

interface RouteRepositoryInterface {
    public function all();
    public function getRoutesByIndexAndValue($index, $value);
    public function find($idroute);
    public function store($data);
    public function update($route,$data);
    public function destroy($route);
    public function getRoutesWithData();
}