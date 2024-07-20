<?php

namespace App\Http\Middleware;

use App\Models\Admin\Invite;
use Closure;
use Illuminate\Http\Request;

class EnsureInviteTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($invite = Invite::where('token', $request->token)->first()) {

            if ($invite->status == 1) {

                return $next($request);
            }

            abort(403);
        }

        abort(404);
    }
}
