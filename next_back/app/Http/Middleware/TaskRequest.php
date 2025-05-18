<?php

namespace App\Http\Middleware;

use App\Repositories\ProjectRepositories;
use App\Repositories\TaskRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class TaskRequest
{
    private TaskRepository $repositories;

    private ProjectRepositories $repositoriesProject;
    public function __construct()
    {
        $this->repositories = new TaskRepository;
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
            'id' => ['required', 'numeric', 'exists:tasks,id'],
        ];
        $validator = Validator::make(['id' => $request->task], $rules);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $status = $this->repositories->get_project_by_id_status((int) $request->route('task'));
        if ($status->project->id !== (int) $request->project_id) {
            $project = $this->repositoriesProject->find((int) $request->project_id);
            return response()->json([
                'errors' => ['данный трекер не является трекером проекта: ' . $project->name],
            ], 422);
        }
        return $next($request);
    }
}
