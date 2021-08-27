<?php

namespace App\Policies;

use App\User;
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
        
    }

    public function createStaff(User $user) {
        if($user->roles()->get()->first()) {
            return $user->roles()->get()->first()->name == "Admin";
        } else {
            return false;
        }  
    }

    public function createCustomer(User $user) {
        if($user->roles()->get()->first()) {
            return $user->roles()->get()->first()->name == "Admin"
             || $user->roles()->get()->first()->name == "Staff";
        } else {
            return false;
        }  
    }
}
