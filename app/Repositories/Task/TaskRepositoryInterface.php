<?php

namespace SigeTurbo\Repositories\Task;

interface TaskRepositoryInterface {
    public function all();
    public function find($idtask);
    public function store($data);
    public function update($task,$data);
    public function getTasks($year = 2015, $period = [], $group = 0, $subject = 0, $approved = false, $sort = null, $order = 'ASC');
    public function getTask($task);
    public function getTasksByUser($user);
    public function setApproved($task);
}