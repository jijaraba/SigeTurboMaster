<?php

namespace SigeTurbo\Repositories\Routebyuser;

interface RoutebyuserRepositoryInterface {
    public function all();
    public function find($routebyuserId);
    public function store($data);
    public function update($routebyuser,$data);
    public function destroy($routebyuser);
    public function getUsersByroute($routebyuserId);
}