<?php

namespace SigeTurbo\Repositories\Achievement;

interface AchievementRepositoryInterface {
    public function all();
    public function find($idachievement);
    public function store($data);
    public function update($achievement,$data);
    public function destroy($achievement);
    public function getAchievements($data);
}