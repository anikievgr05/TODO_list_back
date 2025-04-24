<?php

namespace App\Http\Controllers;

use App\DTO\Project\CreateDTO;
use App\Http\Requests\Project\CreateRequests;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProjectService $service)
    {
        $data = $service->index();
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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
