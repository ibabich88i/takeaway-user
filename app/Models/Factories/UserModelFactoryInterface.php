<?php

declare(strict_types=1);

namespace App\Models\Factories;

use App\DataTransferObjects\UserStoreDTOInterface;
use App\Models\UserModel;

interface UserModelFactoryInterface
{
    /**
     * @param UserStoreDTOInterface $userStoreDTO
     * @return UserModel
     */
    public function create(UserStoreDTOInterface $userStoreDTO): UserModel;
}
