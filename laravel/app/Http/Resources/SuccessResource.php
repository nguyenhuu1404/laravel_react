<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      properties={
 *          @OA\Property(
 *              property="success",
 *              type="bool",
 *              example="true"
 *          ),
 *          @OA\Property(
 *              property="data",
 *              example=null,
 *          ),
 *          @OA\Property(
 *              property="message",
 *              type="string",
 *              example="success"
 *          )
 *      }
 * )
 */
class SuccessResource extends JsonResource
{
    /**
     * @var string
     */
    public $msg;

    public function __construct($msg = 'success')
    {
        $this->msg = $msg;
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        self::withoutWrapping();

        return [
            'data' => null,
            'status' => true,
            'message' => $this->msg,
        ];
    }
}
