<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    // If user is NOT logged in OR is NOT an admin...
    if (!auth()->check() || !auth()->user()->is_admin) {
      abort(403, 'User is not authorized.'); // Stop them
    }

    return $next($request); // Let them pass
  }
}
