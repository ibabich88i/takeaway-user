<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Factories;

use App\DataTransferObjects\UserStoreDTO;
use App\DataTransferObjects\UserStoreDTOInterface;

class UserStoreDTOFactory implements UserStoreDTOFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(array $data): UserStoreDTOInterface
    {
        return new UserStoreDTO(
            $data['name'],
            $data['email'],
            $data['password'],
        );
    }
}
