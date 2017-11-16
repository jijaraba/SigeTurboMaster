<?php

namespace SigeTurbo\Repositories\Prepaidmedical;

interface PrepaidmedicalRepositoryInterface {
    public function all();
    public function find($prepaidmedical);
}