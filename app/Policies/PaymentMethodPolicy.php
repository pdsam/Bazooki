<?php

namespace App\Policies;

use App\Bazooker;
use App\PaymentMethod;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class PaymentMethodPolicy
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

    public function create() {
        return Auth::guard('bazooker')->check();
    }

    public function remove(Bazooker $bazooker, PaymentMethod $method) {
        return $bazooker->getAuthIdentifier() == $method->bazooker()->getAuthIdentifier();
    }
}
