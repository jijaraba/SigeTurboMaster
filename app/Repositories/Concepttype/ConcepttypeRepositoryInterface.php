<?php

namespace SigeTurbo\Repositories\Concepttype;

interface ConcepttypeRepositoryInterface
{
    public function all();
    public function find($concepttype);
}