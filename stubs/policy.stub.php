<?php

namespace Descom\Supervisor\Policies;

use App\User;
use Descom\Supervisor\Models\SupervisorModel;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupervisorPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, SupervisorModel $supervisor)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, SupervisorModel $supervisor)
    {
    }

    public function delete(User $user, SupervisorModel $supervisor)
    {
    }
}
