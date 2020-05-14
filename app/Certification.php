<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $table = 'certification';

    public function auction() {
        return $this->hasOne('App\Auction');
    }
}
