<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\PaginationResource;

class UserPaginationResource extends PaginationResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => UserResource::collection($this->collection),
            'pagination' => $this->pagination,
            'status' => true,
            'message' => $this->msg,
        ];
    }
}
