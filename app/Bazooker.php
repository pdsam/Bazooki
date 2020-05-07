<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Authenticatable as User;

class Bazooker extends Authenticatable implements User
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;
    public $table = 'bazooker';

    protected $guard = 'bazooker';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'description', 'profile_pic'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isMod() {
        return false;
    }

    public function isAdmin() {
        return false;
    }
}
