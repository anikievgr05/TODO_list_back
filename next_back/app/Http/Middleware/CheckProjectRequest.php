<?php

namespace App\Http\Middleware;

use App\Rules\Project\CheckClose;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CheckProjectNameRequest;
use Illuminate\Validation\Rule;

class CheckProjectRequest
{
    public function handle(Request $request, Closure $next)
    {
        $rules = [
            'project_id' => [
                'required',
                'numeric',
                'exists:projects,id',
                // TODo сделать проверку на права можно ли просмотривать закрытые проекты
            ],
        ];
        $validator = Validator::make(['project_id' => $request->route('project_id')], $rules);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        return $next($request);
    }
}
