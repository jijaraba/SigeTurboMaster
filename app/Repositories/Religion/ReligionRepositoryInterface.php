<?php

namespace SigeTurbo\Repositories\Religion;

interface ReligionRepositoryInterface {
    public function all();
    public function find($idreligion);
}