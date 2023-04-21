<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function admin(User $user)
    {
        return $user->role->code === 'admin';
    }

    public function waiter(User $user)
    {
        return $user->role->code === 'waiter';
    }

    public function cook(User $user)
    {
        return $user->role->code === 'cook';
    }

    public function cookOrWaiter(User $user)
    {
        return $user->role->code === 'cook' || $user->role->code === 'waiter';
    }

}
