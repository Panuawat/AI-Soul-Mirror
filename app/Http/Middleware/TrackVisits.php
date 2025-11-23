<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visit;
use Illuminate\Support\Facades\Session;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if already visited in this session
        if (!Session::has('visited')) {
            try {
                Visit::create([
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
                
                Session::put('visited', true);
            } catch (\Exception $e) {
                // Fail silently to not break the app if DB is down
                \Log::error('Visit tracking failed: ' . $e->getMessage());
            }
        }

        return $next($request);
    }
}
