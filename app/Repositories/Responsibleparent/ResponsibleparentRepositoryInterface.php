<?php

namespace SigeTurbo\Repositories\Responsibleparent;

interface ResponsibleparentRepositoryInterface
{
    public function all();
    public function find($responsible);
    public function store($data);
    public function update($idresponsibleparent, $data);
    public function getResponsibleByStudent($responsible);
}