<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\isEmpty;

class EnsureUUIDIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $uuid = $request->header('uuid');
        echo($uuid);
        $users = User::where('uuid', '=', $uuid)->first();
        if (is_null($users)) {
            return response()->json(['error' => "Authentication error"], 401, [], JSON_PRETTY_PRINT);
        } else {
            return $next($request);
        }
    }
}
