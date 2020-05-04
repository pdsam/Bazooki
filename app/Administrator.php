<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Authenticatable as User;

class Administrator extends Authenticatable implements User
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;
    public $table = 'administrator';
    protected $primaryKey = 'mod_id';


    protected $guard = 'admin';

    public function isMod() {
        return true;
    }

    public function isAdmin() {
        return true;
    }
}
