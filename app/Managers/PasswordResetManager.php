<?php

declare(strict_types=1);

namespace App\Managers;

use App\Http\Resources\Factories\PasswordResetResourceFactoryInterface;
use App\Http\Resources\PasswordResetResource;
use App\Models\Factories\PasswordResetModelFactoryInterface;
use App\Repositories\PasswordResetRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

class PasswordResetManager implements PasswordResetManagerInterface
{
    /**
     * @var PasswordResetModelFactoryInterface
     */
    private PasswordResetModelFactoryInterface $passwordResetModelFactory;

    /**
     * @var PasswordResetResourceFactoryInterface
     */
    private PasswordResetResourceFactoryInterface $passwordResetResourceFactory;

    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * @var PasswordResetRepositoryInterface
     */
    private PasswordResetRepositoryInterface $passwordResetRepository;

    /**
     * PasswordResetManager constructor.
     * @param PasswordResetModelFactoryInterface $passwordResetModelFactory
     * @param PasswordResetResourceFactoryInterface $passwordResetResourceFactory
     * @param UserRepositoryInterface $userRepository
     * @param PasswordResetRepositoryInterface $passwordResetRepository
     */
    public function __construct(
        PasswordResetModelFactoryInterface $passwordResetModelFactory,
        PasswordResetResourceFactoryInterface $passwordResetResourceFactory,
        UserRepositoryInterface $userRepository,
        PasswordResetRepositoryInterface $passwordResetRepository
    ) {
        $this->passwordResetModelFactory = $passwordResetModelFactory;
        $this->passwordResetResourceFactory = $passwordResetResourceFactory;
        $this->userRepository = $userRepository;
        $this->passwordResetRepository = $passwordResetRepository;
    }

    /**
     * @inheritDoc
     */
    public function forgot(string $email): PasswordResetResource
    {
        $passwordResetModel = $this->passwordResetModelFactory->create($email);
        $passwordResetModel->save();

        return $this->passwordResetResourceFactory->create($passwordResetModel);
    }
}
