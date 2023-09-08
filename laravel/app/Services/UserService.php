<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\Interfaces\UserServiceInterface;
use App\Http\Requests\Users\IndexUserRequest;

class UserService implements UserServiceInterface
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function index(IndexUserRequest $request)
    {
        return $this->userRepository->paginate();
    }

    public function show(int $id)
    {
        return $this->userRepository->find($id);
    }

    public function store(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->userRepository->update($data, $id);
    }

    public function destroy(int $id)
    {
        return $this->userRepository->delete($id);
    }
}