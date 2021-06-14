<?php

declare(strict_types=1);

namespace App\Managers;

use App\DataTransferObjects\UserStoreDTOInterface;
use App\Http\Resources\Factories\UserResourceFactoryInterface;
use App\Http\Resources\UserResource;
use App\Models\Factories\UserModelFactoryInterface;
use Psr\Log\LoggerInterface;

class UserManager implements UserManagerInterface
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @var UserModelFactoryInterface
     */
    private UserModelFactoryInterface $userModelFactory;

    /**
     * @var UserResourceFactoryInterface
     */
    private UserResourceFactoryInterface $userResourceFactory;

    /**
     * UserManager constructor.
     * @param LoggerInterface $logger
     * @param UserModelFactoryInterface $userModelFactory
     * @param UserResourceFactoryInterface $userResourceFactory
     */
    public function __construct(
        LoggerInterface $logger,
        UserModelFactoryInterface $userModelFactory,
        UserResourceFactoryInterface $userResourceFactory
    ) {
        $this->logger = $logger;
        $this->userModelFactory = $userModelFactory;
        $this->userResourceFactory = $userResourceFactory;
    }

    /**
     * @inheritDoc
     */
    public function store(UserStoreDTOInterface $userStoreDTO): UserResource
    {
        $user = $this->userModelFactory->create($userStoreDTO);
        $user->save();

        $this->logger->info(
            sprintf('User "%s" with email "%s" where created.', $user->name, $user->email)
        );

        return $this->userResourceFactory->create($user);
    }
}
