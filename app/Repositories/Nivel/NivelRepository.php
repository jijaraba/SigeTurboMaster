<?php

namespace SigeTurbo\Repositories\Nivel;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Nivel;

class NivelRepository implements NivelRepositoryInterface
{
    /**
     * Get All Nivels
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('nivels', 1440, function() {
            return Nivel::all();
        });
    }

    /**
     * Find Nivel
     * @param $idnivel
     * @return mixed
     */
    public function find($idnivel)
    {
        return Nivel::find($idnivel);
    }

    /**
     * Get Nivels By Years and Period and Group and Subject
     * @param int $year Año Académico
     * @param int $period Periodo Académico
     * @param int $group Grupo Académico
     * @param int $subject Asignatura
     * @param null $user Identificación del usuario
     * @return mixed
     */
    public function getNivels($year = 1995, $period = 1, $group = 1, $subject = 1, $user = null)
    {
        $nivels = Nivel::select('nivels.idnivel', 'nivels.name')
            ->join('subjects', 'subjects.idsubject', '=', 'nivels.idsubject')
            ->join('contracts', 'contracts.idnivel', '=', 'nivels.idnivel')
            ->join('years', 'years.idyear', '=', 'contracts.idyear')
            ->join('periods', 'periods.idperiod', '=', 'contracts.idperiod')
            ->join('groups', 'groups.idgroup', '=', 'contracts.idgroup')
            ->where('years.idyear', '=', $year)
            ->where('periods.idperiod', '=', $period)
            ->where('groups.idgroup', '=', $group)
            ->where('contracts.idsubject', '=', $subject)
            ->orderBy('nivels.name');
        if ($user) {
            $nivels
                ->join('users', 'users.iduser', '=', 'contracts.iduser')
                ->where('users.iduser', '=', $user);
        }
        return $nivels
            ->groupBy('nivels.idnivel')
            ->get();

    }

    /**
     * Get Nivels By Subject
     * @param int $subject Asignatura
     * @return mixed
     */
    public function getNivelsBySubject($subject = 1)
    {
        return Nivel::select('nivels.idnivel', 'nivels.name')
            ->where('nivels.idsubject', '=', $subject)
            ->orderBy('nivels.name')
            ->get();
    }

    /**
     * Get Nivels By Years and Period and Group and Subject and area
     * @param int $year Año Académico
     * @param int $period Periodo Académico
     * @param int $group Grupo Académico
     * @param int $subject Asignatura
     * @param null $user Identificación del usuario
     * @return mixed
     */
    public function getNivelsByArea($year = 1995, $period = 1, $group = 1, $subject = 1, $user = null)
    {
        $nivels = Nivel::select('nivels.idnivel', 'nivels.name')
            ->join('subjects', 'subjects.idsubject', '=', 'nivels.idsubject')
            ->join('contracts', 'contracts.idnivel', '=', 'nivels.idnivel')
            ->join('areamanagers', 'areamanagers.idarea', '=', 'subjects.idarea')
            ->join('years', 'years.idyear', '=', 'contracts.idyear')
            ->join('periods', 'periods.idperiod', '=', 'contracts.idperiod')
            ->join('groups', 'groups.idgroup', '=', 'contracts.idgroup')
            ->where('years.idyear', '=', $year)
            ->where('periods.idperiod', '=', $period)
            ->where('groups.idgroup', '=', $group)
            ->where('subjects.idsubject', '=', $subject)
            ->orderBy('nivels.name');
        if ($user) {
            $nivels
                ->join('users', 'users.iduser', '=', 'areamanagers.iduser')
                ->where('users.iduser', '=', $user);
        }
        return $nivels
            ->groupBy('nivels.idnivel')
            ->get();

    }

}