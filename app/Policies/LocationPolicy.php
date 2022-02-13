<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocationPolicy
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
    
    // in body of class ProductPolicy    
    function update(User $user) {
        return $user->isAdministrator();
    }

}
