<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Factories;

use App\DataTransferObjects\UserStoreDTOInterface;

interface UserStoreDTOFactoryInterface
{
    /**
     * @param array $data
     * @return UserStoreDTOInterface
     */
    public function create(array $data): UserStoreDTOInterface;
}
