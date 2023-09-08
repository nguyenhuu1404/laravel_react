<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Users\IndexUserRequest;

interface UserServiceInterface
{
    public function index(IndexUserRequest $request);

    public function show(int $id);

    public function store(array $data);

    public function update(array $data, int $id);

    public function destroy(int $id);
}