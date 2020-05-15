<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    public $timestamps = false;
    protected $table = 'payment_method';

    protected $fillable = ['bazooker_id', 'card_number', 'type', 'validated'];

    public function bazooker() {
        return $this->belongsTo('App\Bazooker');
    }
}
