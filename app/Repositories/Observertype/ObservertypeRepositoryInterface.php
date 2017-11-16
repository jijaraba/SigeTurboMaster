<?php

namespace SigeTurbo\Repositories\Observertype;

interface ObservertypeRepositoryInterface {
    public function all();
    public function find($idobservertype);
}