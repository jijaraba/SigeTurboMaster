<?php namespace SigeTurbo\Repositories\Gender;

interface GenderRepositoryInterface {
    public function all();
    public function find($idgender);
}