<?php

namespace App\Http\Controllers;

use App\DTO\Status\ChangeOrderDTO;
use App\DTO\Status\CloseDTO;
use App\DTO\Status\IndexDTO;
use App\DTO\Status\NextStatusValidDTO;
use App\DTO\Status\ShowValidDTO;
use App\DTO\Status\StoreDTO;
use App\DTO\Status\UpdateDTO;
use App\Http\Requests\Status\ChangeOrderRequest;
use App\Http\Requests\Status\CloseRequest;
use App\Http\Requests\Status\IndexRequest;
use App\Http\Requests\Status\NextStatusRequest;
use App\Http\Requests\Status\ShowRequest;
use App\Http\Requests\Status\StoreRequest;
use App\Http\Requests\Status\UpdateRequest;
use App\Services\StatusService;

class StatusContoller extends Controller
{
    private StatusService $service;

    public function __construct()
    {
        $this->service = new StatusService;
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

    public function next_status(NextStatusRequest $request)
    {
        $dto = NextStatusValidDTO::fromArray($request->validated());
        $data = $this->service->next_status($dto);
        return response()->json([
            $data->toArray(),
        ], 201);
    }
}
