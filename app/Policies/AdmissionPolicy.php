<?php

namespace SigeTurbo\Policies;

use SigeTurbo\Acl;
use SigeTurbo\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdmissionPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        if (Acl::isAllow('admissions.dashboard', getUser()->role_selected)) {
            return true;
        }
        return false;
    }
}
