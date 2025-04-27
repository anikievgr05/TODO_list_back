<?php

namespace App\Http\Controllers;

use App\DTO\Project\CloseDTO;
use App\DTO\Project\CreateDTO;
use App\DTO\Project\GetByNameDTO;
use App\DTO\Project\UpdateDTO;
use App\DTO\ShowDTO;
use App\Http\Requests\Project\CreateRequests;
use App\Http\Requests\Project\CloseRequests;
use App\Http\Requests\Project\GetByNameRequest;
use App\Http\Requests\Project\IndexRequest;
use App\Http\Requests\Project\ShowClosedProjectRequest;
use App\Http\Requests\Project\ShowRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request, ProjectService $service)
    {
        if (!$request->with_closed){
            $data = $service->index();
        } else {
            $data = $service->all_with_closed();
        }
        return response()->json($data->toArray(), 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequests $request, ProjectService $service): JsonResponse
    {
        $dto = CreateDTO::fromArray($request->validated());
        $data = $service->create($dto);
        return response()->json([
            'data' => $data->toArray(),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowRequest $request, ProjectService $service)
    {
        $dto = ShowDTO::fromArray(['id' => (int) $request->route('project')]);
        $data = $service->show($dto);
        return response()->json([
            'project' => $data->toArray()
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, ProjectService $service)
    {
        $dto = UpdateDTO::fromArray($request->validated());
        $data = $service->update($dto);
        return response()->json([
            'project' => $data->toArray()
        ], 201);
    }

    /**
     * получаем проект по id даже если он заблокирован
     */
    public function get_closed_project(ShowClosedProjectRequest $request, ProjectService $service)
    {
        $dto = ShowDTO::fromArray(['id' => (int) $request->route('project')]);
        $data = $service->show($dto);
        return response()->json([
            'project' => $data->toArray()
        ], 201);
    }

    /**
     * Закрывает проект
     */
    public function close(CloseRequests $request, ProjectService $service)
    {
        $dto = CloseDTO::fromArray($request->validated());
        $data = $service->close($dto);
        return response()->json([
            'project' => $data->toArray()
        ], 201);
    }

    public function get_by_name(GetByNameRequest $request, ProjectService $service)
    {
        $dto = GetByNameDTO::fromArray($request->validated());
        $data = $service->get_by_name($dto);
        return response()->json([
            'project' => $data->toArray()
        ], 201);
    }
}
