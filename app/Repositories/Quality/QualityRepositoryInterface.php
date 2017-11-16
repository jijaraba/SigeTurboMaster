<?php

namespace SigeTurbo\Repositories\Quality;

interface QualityRepositoryInterface
{
    public function all();
    public function find($quality);
}