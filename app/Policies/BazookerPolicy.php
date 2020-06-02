<?php

namespace App\Policies;

use App\Bazooker;
use Illuminate\Auth\Access\HandlesAuthorization;

class BazookerPolicy
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

    public function editProfile(Bazooker $auth, Bazooker $toChange) {
        return $auth->id == $toChange->id;
    }

    public function deleteAccount(Bazooker $auth, Bazooker $toChange){
        return $auth->id == $toChange->id;
    }
}
