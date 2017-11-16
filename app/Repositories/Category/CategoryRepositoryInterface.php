<?php

namespace SigeTurbo\Repositories\Category;

interface CategoryRepositoryInterface
{
    public function all();
    public function find($idcategory);
}