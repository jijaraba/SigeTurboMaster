<?php

namespace SigeTurbo\Policies;

use SigeTurbo\Acl;
use SigeTurbo\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParentPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        if (Acl::isAllow('parents.dashboard', getUser()->role_selected)) {
            return true;
        }
        return false;
    }
}
