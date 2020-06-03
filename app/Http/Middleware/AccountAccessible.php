<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AccountAccessible
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $baz = Auth::guard('bazooker')->user();
        if (is_null($baz)) {
            return $next($request);
        }

        if (strcmp($baz->status, 'deleted') == 0) {
            Auth::logout();
            return redirect()->route('auctions')->withErrors(['nonexistant'=>'This account doesn\'t exist']);
        }

        if ($baz->isBanned()) {
            Auth::logout();
            return redirect()->route('auctions')->withErrors([
                'banned' => 'This account was banned.'
            ]);
        }
        if ($baz->isSuspended()) {
            $suspended = $baz->suspensions()->whenRaw('time_of_suspension + duration * interval \'1 second\' > CURRENT_TIMESTAMP')->get()[0];
            $seconds = $suspended->duration;
            $time = $suspended->time_of_suspension->modify("+$seconds seconds");

            Auth::logout();
            return redirect()->route('auctions')->withErrors([
                'suspended' => "This account is suspended until $time."
            ]);
        }

        return $next($request);
    }
}
