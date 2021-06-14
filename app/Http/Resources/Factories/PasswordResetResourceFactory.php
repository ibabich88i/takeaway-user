<?php

declare(strict_types=1);

namespace App\Http\Resources\Factories;

use App\Http\Resources\PasswordResetResource;
use App\Models\PasswordResetModel;

class PasswordResetResourceFactory implements PasswordResetResourceFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(PasswordResetModel $model): PasswordResetResource
    {
        return new PasswordResetResource($model);
    }
}
