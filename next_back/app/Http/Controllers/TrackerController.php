<?php

namespace App\Http\Controllers;

use App\DTO\Tracker\StoreDTO;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Tracker\CreateRequests;
use App\Services\TrackerService;
use Illuminate\Http\Request;

class TrackerController extends Controller
{
    private TrackerService $service;

    public function __construct() {
        $this->service = new TrackerService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        $data = $this->service->index($request->validated());
        return response()->json($data->toArray(), 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequests $request)
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
}
