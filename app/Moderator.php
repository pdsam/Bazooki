<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Authenticatable as User;

class Moderator extends Authenticatable implements User
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;
    public $table = 'moderator';

    protected $guard = 'mod';

    protected $fillable = [
        'email',
        'password'
    ];

    public function isMod() {
        return true;
    }

    public function isAdmin() {
        return false;
    }
}
