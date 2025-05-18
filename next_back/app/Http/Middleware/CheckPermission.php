<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Получаем имя текущего роута
        $routeName = $request->route()->getName();
        if (!$routeName) {
            abort(404, 'Route not found.');
        }
        $permission = $routeName;

        $projectId = $request->route('project_id');

//        $user = auth()->user();
        // TODO для теста
        $user = User::find(10);
//        dd($user->hasPermission($permission, $projectId));
        if (!$user->hasPermission($permission, $projectId)) {
            return response()->json([
                'error' => "You don't have permission to '{$permission}'" . ($projectId ? " in this project" : "")
            ], 403);
        }

        return $next($request);
    }
}
