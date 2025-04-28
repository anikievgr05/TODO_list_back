<?php

namespace App\Http\Controllers;

use App\DTO\Role\CloseDTO;
use App\DTO\Role\IndexDTO;
use App\DTO\Role\ShowValidDTO;
use App\DTO\Role\StoreDTO;
use App\DTO\Role\UpdateDTO;
use App\Http\Requests\Role\CloseRequest;
use App\Http\Requests\Role\IndexRequest;
use App\Http\Requests\Role\ShowRequest;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Services\RoleService;

class RoleController extends Controller
{
    private RoleService $service;
    public function __construct()
    {
        $this->service = new RoleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        $dto = IndexDTO::fromArray($request->validated());
        $data = $this->service->index($dto);
        return response()->json($data->toArray(), 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $dto = StoreDTO::fromArray($request->validated());
        $data = $this->service->store($dto);
        return response()->json([
            $data->toArray(),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowRequest $request)
    {
        $dto = ShowValidDTO::fromArray($request->validated());
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

    /**
     * Remove the specified resource from storage.
     */
    public function close(CloseRequest $request)
    {
        $dto = CloseDTO::fromArray($request->validated());
        $data = $this->service->close($dto);
        return response()->json([
            $data->toArray()
        ], 201);
    }
}
