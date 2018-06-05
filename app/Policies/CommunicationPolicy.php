<?php

namespace SigeTurbo\Policies;

use SigeTurbo\Acl;
use SigeTurbo\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommunicationPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        if (Acl::isAllow('communications.dashboard', getUser()->role_selected)) {
            return true;
        }
        return false;
    }
}
