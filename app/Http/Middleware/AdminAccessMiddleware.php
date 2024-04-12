<?php

namespace App\Http\Middleware;

use App\Exceptions\AdminAccessException;
use App\Interfaces\UserRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next)
    {
        $repository = app(UserRepository::class);
        $user = $repository->getUserByToken($request->bearerToken());
        $accessGranted = false;
        foreach ($user->roles as $role) {
            if ($role['role'] == 'Администратор')
                $accessGranted = true;
        }
        return ($accessGranted) ? $next($request) : \response()->json('Вы не админ', 403, [], 256);
    }
}
