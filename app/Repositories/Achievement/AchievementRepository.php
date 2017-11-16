<?php

namespace SigeTurbo\Repositories\Achievement;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Achievement;
use SigeTurbo\Group;

class AchievementRepository implements AchievementRepositoryInterface
{

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('achievements', 1440, function () {
            return Achievement::all();
        });
    }

    /**
     * Find in Databases
     * @param $idachievement
     * @return mixed
     */
    public function find($idachievement)
    {
        return Achievement::find($idachievement);
    }

    /**
     * Save Achievement
     * @param $data
     * @return static
     */
    public function store($data)
    {

        //Find Grade
        $grade = Group::find($data['group']);

        return Achievement::create(array(
            'idyear' => $data['year'],
            'idperiod' => $data['period'],
            'idgrade' => $grade->idgrade,
            'idsubject' => $data['subject'],
            'idnivel' => $data['nivel'],
            'achievement' => $data['achievement'],
        ));
    }

    /**
     * Update Achievement
     * @param $achievement
     * @param $data
     * @return mixed
     */
    public function update($achievement, $data)
    {
        $achievement = Achievement::find($achievement);
        $achievement->fill(array(
            'achievement' => $data['achievement']
        ));
        return $achievement->save();
    }

    /**
     * Delete Achievement
     * @param $achievement
     * @return mixed
     */
    public function destroy($achievement)
    {
        $achievement = Achievement::find($achievement);
        return $achievement->delete();

    }

    /**
     * Get Achievement
     * @param $data
     * @return mixed
     */
    public function getAchievements($data)
    {
        $group = $data['group'];


        return Achievement::where('idyear', "=", $data['year'])
            ->where("idperiod", "=", $data['period'])
            ->whereIn('achievements.idgrade', function ($query) use ($group) {
                $query
                    ->select('grades.idgrade')
                    ->from('grades')
                    ->join('groups', function ($join) use ($group) {
                        $join
                            ->on('groups.idgrade', '=', 'grades.idgrade');
                    })->where('groups.idgroup', '=', $group);
            })
            ->where("idsubject", "=", $data['subject'])
            ->where("idnivel", "=", $data['nivel'])
            ->with('indicators')
            ->get();


    }
}
