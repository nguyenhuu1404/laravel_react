<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\IndexUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Requests\Users\StoreUserRequest;
use App\Services\Interfaces\UserServiceInterface;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\Users\UserResource;
use App\Http\Resources\Users\UserPaginationResource;

class UserController extends Controller
{
    private $userService;

    public function __construct(
        UserServiceInterface $userService
    ) {
        $this->userService = $userService;
    }

    /**
     * Detail user
     *
     * @param int $id
     * @return UserResource
     */
    public function index(IndexUserRequest $request): UserPaginationResource
    {
        $users =  $this->userService->index($request);

        return new UserPaginationResource($users);
    }

    /**
     * Detail user
     *
     * @param int $id
     * @return UserResource
     */
    public function show(int $id): UserResource
    {
        $user = $this->userService->show($id);

        return new UserResource($user);
    }

    /**
     * Create user
     *
     * @param StoreUserRequest $request,
     * @return UserResource
     */
    public function store(StoreUserRequest $request): UserResource
    {
        $user = $this->userService->store($request->all());

        return new UserResource($user);
    }

    /**
     * Update user
     *
     * @param int $id,
     * @param UpdateUserRequest $request,
     * @return UserResource
     */
    public function update(UpdateUserRequest $request, int $id): UserResource
    {
        $data = $request->only(['first_name', 'last_name', 'email', 'status']);
        $user = $this->userService->update($data, $id);

        return new UserResource($user);
    }

    /**
     * Delete user
     *
     * @param int $id
     * @return SuccessResource
     */
    public function destroy(int $id): SuccessResource
    {
        $this->userService->destroy($id);

        return new SuccessResource('Delete success');
    }
}
