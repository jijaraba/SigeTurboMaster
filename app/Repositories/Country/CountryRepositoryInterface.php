<?php

namespace SigeTurbo\Repositories\Country;

interface CountryRepositoryInterface {
    public function all();
    public function find($country);
}