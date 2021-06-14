<?php

declare(strict_types=1);

namespace App\Models\Factories;

use App\DataTransferObjects\UserStoreDTOInterface;
use App\Models\UserModel;
use Illuminate\Hashing\HashManager;

class UserModelFactory implements UserModelFactoryInterface
{
    /**
     * @var HashManager
     */
    private HashManager $hashManager;

    /**
     * UserModelFactory constructor.
     * @param HashManager $hashManager
     */
    public function __construct(HashManager $hashManager)
    {
        $this->hashManager = $hashManager;
    }

    /**
     * @inheritDoc
     */
    public function create(UserStoreDTOInterface $userStoreDTO): UserModel
    {
        return new UserModel(
            [
                'email' => $userStoreDTO->getEmail(),
                'name' => $userStoreDTO->getName(),
                'password' => $this->hashManager->make($userStoreDTO->getPassword())
            ]
        );
    }
}
