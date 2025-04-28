<?php

namespace App\Http\Controllers;

use App\DTO\Tracker\ShowDTO;
use App\DTO\Tracker\StoreDTO;
use App\DTO\Tracker\UpdateDTO;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Tracker\CreateRequests;
use App\Http\Requests\Tracker\ShowRequest;
use App\Http\Requests\Tracker\UpdateRequest;
use App\Services\TrackerService;
use Illuminate\Http\JsonResponse;

class TrackerController extends Controller
{
    private TrackerService $service;

    public function __construct() {
        $this->service = new TrackerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request): JsonResponse
    {
        $data = $this->service->index($request->validated());
        return response()->json($data->toArray(), 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequests $request): JsonResponse
    {
        $dto = StoreDTO::fromArray($request->validated());
        $data = $this->service->create($dto);
        return response()->json([
            $data->toArray(),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowRequest $request): JsonResponse
    {
        $dto = ShowDTO::fromArray(['id' => (int) $request->route('tracker')]);
        $data = $this->service->show($dto);
        return response()->json([
            $data->toArray(),
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request)
    {
        $dto = UpdateDTO::fromArray($request->validated());
        $data = $this->service->update($dto);
        return response()->json([
            $data->toArray(),
        ], 201);
    }
}
