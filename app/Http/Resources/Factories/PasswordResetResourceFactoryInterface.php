<?php

declare(strict_types=1);

namespace App\Http\Resources\Factories;

use App\Http\Resources\PasswordResetResource;
use App\Models\PasswordResetModel;

interface PasswordResetResourceFactoryInterface
{
    /**
     * @param PasswordResetModel $model
     * @return PasswordResetResource
     */
    public function create(PasswordResetModel $model): PasswordResetResource;
}
