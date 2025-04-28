<?php

namespace App\Http\Middleware;

use App\Repositories\ProjectRepositories;
use App\Repositories\TrackerRepositories;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CheckTrackerInProjectRequest
{
    private TrackerRepositories $repositories;

    private ProjectRepositories $repositoriesProject;
    public function __construct()
    {
        $this->repositories = new TrackerRepositories;
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
            'tracker' => ['required', 'numeric', 'exists:trackers,id'],
        ];
        $validator = Validator::make(['tracker' => $request->route('tracker')], $rules);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $tracker= $this->repositories->get_project_by_id_tracker((int) $request->route('tracker'));
        if ($tracker->project->id !== (int) $request->route('project_id')) {
            $project = $this->repositoriesProject->find((int) $request->route('project_id'));
            return response()->json([
                'errors' => ['данный трекер не является трекером проекта: ' . $project->name],
            ], 422);
        }
        return $next($request);
    }
}
