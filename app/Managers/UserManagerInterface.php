<?php

declare(strict_types=1);

namespace App\Managers;

use App\DataTransferObjects\UserStoreDTOInterface;
use App\Http\Resources\UserResource;

interface UserManagerInterface
{
    /**
     * @param UserStoreDTOInterface $userStoreDTO
     * @return UserResource
     */
    public function store(UserStoreDTOInterface $userStoreDTO): UserResource;
}
