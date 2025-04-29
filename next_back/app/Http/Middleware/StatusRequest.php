<?php

namespace App\Http\Middleware;

use App\Repositories\ProjectRepositories;
use App\Repositories\StatusRepositories;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class StatusRequest
{
    private StatusRepositories $repositories;

    private ProjectRepositories $repositoriesProject;
    public function __construct()
    {
        $this->repositories = new StatusRepositories;
        $this->repositoriesProject = new ProjectRepositories();

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $rules = [
            'id' => ['required', 'numeric', 'exists:statuses,id'],
        ];
        $validator = Validator::make(['id' => $request->status], $rules);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $status = $this->repositories->get_project_by_id_status((int) $request->route('status'));
        if ($status->project->id !== (int) $request->project_id) {
            $project = $this->repositoriesProject->find((int) $request->project_id);
            return response()->json([
                'errors' => ['данный трекер не является трекером проекта: ' . $project->name],
            ], 422);
        }
        return $next($request);
    }
}
