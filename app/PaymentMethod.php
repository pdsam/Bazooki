<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_method';

    public function bazooker() {
        return $this->hasOne('App\Bazooker');
    }
}
