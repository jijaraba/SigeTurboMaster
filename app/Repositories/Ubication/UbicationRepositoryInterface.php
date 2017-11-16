<?php

namespace SigeTurbo\Repositories\Ubication;

interface UbicationRepositoryInterface
{
    public function all();
    public function find($ubication);
    public function getUbications($excludeSector);
}