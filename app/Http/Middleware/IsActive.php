<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class IsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$roles
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $roles = empty($roles) ? [null] : $roles;

        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        if ($user->disabled || ! is_null($user->end_date)) {
            Auth::logout();

            return redirect()->route('login');
        }

        //active user must have at least a ICI User role
        if (! $user->hasRole(Role::ICI_USER)) {
            return Inertia::render('Home', [
                'loginAttempt' => true,
                'hasAccess' => false,
                'status' => 'Please contact ICI Admin to grant you access.',
            ]);
        }

        return $next($request);
    }
}
