<?php

namespace App\Http\Controllers;

use App\DTO\Task\CreateDTO;
use App\DTO\Task\IndexDTO;
use App\DTO\Task\ShowValidDTO;
use App\DTO\Task\UpdateDTO;
use App\Http\Requests\Task\ChangeStatusRequest;
use App\Http\Requests\Task\CreateRequest;
use App\Http\Requests\Task\GetFileRequest;
use App\Http\Requests\Task\IndexRequest;
use App\Http\Requests\Task\ShowRequest;
use App\Http\Requests\Task\TaskDeleteFileRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public TaskService $service;

    public function __construct()
    {
        $this->service = new TaskService;
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
    public function store(CreateRequest $request)
    {
        $dto = CreateDTO::fromArray($request->validated());
        $data = $this->service->create($dto);
        return response()->json($data->toArray(), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowRequest $request)
    {
        $dto = ShowValidDTO::fromArray(['id' => $request->task]);
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
    public function destroy(string $id)
    {
        //
    }

    public function get_file(GetFileRequest $request)
    {
        return response()->download($this->service->get_file($request->validated()));
    }

    public function change_status(ShowRequest $request)
    {
        $dto = ShowValidDTO::fromArray(['id' => $request->task]);
        $data = $this->service->change_status($dto);
        return response()->json([
            $data->toArray(),
        ], 201);
    }

    public function delete_file(TaskDeleteFileRequest $request)
    {
        $data = $this->service->delete_file($request->validated());
        return response()->json([
            $data->toArray(),
        ], 201);
    }
}
