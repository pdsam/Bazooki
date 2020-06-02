<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    public $timestamps  = false;
    public $table = 'ban';

    protected $fillable = ['admin_id','bazooker_id','reason'];

    public function admin(){
        return $this->belongsTo('App\Administrator');
    }

    public function bazooker(){
        return $this->belongsTo('App\Bazooker');
    }
}
