<?php

namespace SigeTurbo\Points;

use Illuminate\Support\Facades\Auth;
use SigeTurbo\User;

class Points
{

    public static function setPoints($points)
    {

        $user = User::find(getUser()->iduser);
        $user->points = $user->points + $points;
        $user->save();
    }

    public static function getPoints()
    {
        return array(
            'points' => User::find(getUser()->iduser)->points
        );
    }

}