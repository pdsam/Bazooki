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

    public function ownAuctions() {
        return $this->hasMany('App\Auction', 'owner');
    }

    public function wonItems() {
        return $this->hasMany('App\Auction', 'highest_bidder')->where('status', '=', 'over');
    }

    public function bids() {
        return $this->hasMany('App\Bid', 'bidder_id');
    }

    public function paymentMethods() {
        return $this->hasMany('App\PaymentMethod', "bazooker_id");
    }

    public function photo() {
        if (file_exists( public_path() . "/storage/avatars/$this->id")) {
            return "/storage/avatars/$this->id";
        } else {
            return '/assets/default_profile_pic.jpg';
        }
    }

    public function bans(){
        return $this->hasMany('App\Ban','bazooker_id');
    }

    public function ban() {
        return $this->bans()->where('active', '=', true);
    }

    public function suspensions(){
        return $this->hasMany('App\Suspension','bazooker_id');
    }

    public function mostRecentSuspension() {
        return $this->suspensions()->orderBy('time_of_suspension')->first();
    }

    public function isBanned(){
        return $this->bans()->exists();

    }

    public function isSuspended(){
        return strcmp($this->status, 'suspended') == 0;
    }

    public function winnerFeedbackAVG() {
        return $this->hasMany('App\Feedback', 'rated_id')
            ->where('ftype', '=', 'winner')
            ->avg('rating');
    }

    public function winnerFBCount() {
        return $this->hasMany('App\Feedback', 'rated_id')
            ->where('ftype', '=', 'winner')
            ->count();
    }

    public function auctioneerFeedbackAVG() {
        return $this->hasMany('App\Feedback', 'rated_id')
            ->where('ftype', '=', 'auction')
            ->avg('rating');
    }

    public function auctioneerFBCount() {
        return $this->hasMany('App\Feedback', 'rated_id')
            ->where('ftype', '=', 'auction')
            ->count();
    }
}
