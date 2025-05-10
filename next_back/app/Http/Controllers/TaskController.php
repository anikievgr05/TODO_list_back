<?php

namespace App\Http\Controllers;

use App\DTO\Task\CreateDTO;
use App\Http\Requests\Task\CreateRequest;
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
    public function index()
    {
        //
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
