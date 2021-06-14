<?php

declare(strict_types=1);

namespace App\Http\Resources\Factories;

use App\Http\Resources\UserResource;
use App\Models\UserModel;

interface UserResourceFactoryInterface
{
    /**
     * @param UserModel $userModel
     * @return UserResource
     */
    public function create(UserModel $userModel): UserResource;
}
