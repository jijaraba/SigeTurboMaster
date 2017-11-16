<?php

namespace SigeTurbo\Repositories\Visitor;

interface VisitorRepositoryInterface {
    public function all();
    public function find($idvisitor);
    public function store($data);
    public function update($idvisitor,$data);
    public function destroy($idvisitor);
    public function generateCode();
    public function getVisitorsNow();
    public function checkin($data);
    public function checkout($data);
}