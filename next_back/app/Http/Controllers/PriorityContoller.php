<?php

namespace App\Http\Controllers;

use App\DTO\Priority\ChangeOrderDTO;
use App\DTO\Priority\CloseDTO;
use App\DTO\Priority\IndexDTO;
use App\DTO\Priority\ShowValidDTO;
use App\DTO\Priority\StoreDTO;
use App\DTO\Priority\UpdateDTO;
use App\Http\Requests\Priority\ChangeOrderRequest;
use App\Http\Requests\Priority\CloseRequest;
use App\Http\Requests\Priority\IndexRequest;
use App\Http\Requests\Priority\ShowRequest;
use App\Http\Requests\Priority\StoreRequest;
use App\Http\Requests\Priority\UpdateRequest;
use App\Services\PriorityService;

class PriorityContoller extends Controller
{
    private PriorityService $service;

    public function __construct()
    {
        $this->service = new PriorityService;
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

    public function change_order(ChangeOrderRequest $request)
    {
        $dto = ChangeOrderDTO::fromArray($request->validated());
        $data = $this->service->change_order($dto);
        return response()->json([
            $data->toArray()
        ], 201);
    }
}
