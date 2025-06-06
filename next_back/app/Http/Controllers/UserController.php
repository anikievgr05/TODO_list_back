<?php

namespace App\Http\Controllers;

use App\DTO\User\FireAllDTO;
use App\DTO\User\FireDTO;
use App\DTO\User\IndexDTO;
use App\DTO\User\ShowDTO;
use App\DTO\User\ShowValidDTO;
use App\DTO\User\StoreDTO;
use App\DTO\User\UpdateDTO;
use App\DTO\User\UpdateRoleDTO;
use App\Http\Requests\User\FireAllRequest;
use App\Http\Requests\User\FireRequest;
use App\Http\Requests\User\IndexRequest;
use App\Http\Requests\User\ShowRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\UpdateRoleRequest;
use App\Http\Requests\User\UpdateUserGlobalRequest;
use App\Services\ProjectService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private UserService $service;

    public function __construct()
    {
        $this->service = new UserService;
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
        return response()->json($data->toArray(), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowRequest $request)
    {
        $dto = ShowValidDTO::fromArray($request->validated());
        $data = $this->service->show($dto);
        return response()->json($data->toArray(), 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request)
    {
        $dto = UpdateDTO::fromArray($request->validated());
        $data = $this->service->update($dto);
        return response()->json($data->toArray(), 201);
    }

    public function update_global(UpdateUserGlobalRequest $request)
    {
        $dto = UpdateDTO::fromArray($request->validated());
        $data = $this->service->update($dto);
        return response()->json($data->toArray(), 201);

    }

    public function fire(FireRequest $request)
    {
        $dto = FireDTO::fromArray($request->validated());
        $data = $this->service->fire($dto);
        return response()->json($data, 201);
    }

    public function fire_all(FireAllRequest $request)
    {
        $dto = FireAllDTO::fromArray($request->validated());
        $data = $this->service->fire_all($dto);
        return response()->json($data, 201);
    }

    public function update_role(UpdateRoleRequest $request)
    {
        $dto = UpdateRoleDTO::fromArray($request->validated());
        $data = $this->service->update_role($dto);
        return response()->json($data->toArray(), 201);
    }
    public function get_projects_for_me(Request $request)
    {
        $data = $this->service->get_projects_for_me();
        return response()->json($data->toArray(), 201);
    }
}
