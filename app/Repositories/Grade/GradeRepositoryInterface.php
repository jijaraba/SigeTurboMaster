<?php

namespace SigeTurbo\Repositories\Grade;

interface GradeRepositoryInterface
{
    public function all();
    public function find($grade);
}