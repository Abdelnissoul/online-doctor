<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Online
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return string|null
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // $id = Auth::user()->user_id;
            // $user = User::find($id);
            // $user->update([
            //     'user_last_action' => now(),
            // ]);
            $expireAt = Carbon::now()->addMinutes(2);
            Cache::put('user-is-online-'.Auth::user()->user_id, true, $expireAt);
        }

        return $next($request);
    }
}
