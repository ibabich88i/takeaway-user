<?php

declare(strict_types=1);

namespace App\Http\Resources\Factories;

use App\Http\Resources\UserResource;
use App\Models\UserModel;

class UserResourceFactory implements UserResourceFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(UserModel $userModel): UserResource
    {
        return new UserResource($userModel);
    }
}
