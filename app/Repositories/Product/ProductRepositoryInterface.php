<?php

namespace SigeTurbo\Repositories\Product;

interface ProductRepositoryInterface
{
    public function all();
    public function find($idpurchase);
    public function code($code);

}