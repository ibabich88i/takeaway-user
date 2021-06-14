<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\PasswordResetModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property PasswordResetModel $resource
 */
class PasswordResetResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'token' => $this->resource->token,
        ];
    }
}
