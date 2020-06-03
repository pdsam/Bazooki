<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suspension extends Model
{
    public $timestamps  = false;
    public $table = 'suspension';

    protected $dates = ['time_of_suspension'];

    protected $fillable = ['mod_id','bazooker_id','reason','duration'];

    public function mod(){
        return $this->belongsTo('App\Moderator');
    }

    public function bazooker(){
        return $this->belongsTo('App\Bazooker');
    }

    public function getDateFormat()
    {
        return 'Y-m-d H:i:s+P';
    }
}
