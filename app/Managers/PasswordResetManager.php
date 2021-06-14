<?php

declare(strict_types=1);

namespace App\Managers;

use App\DataTransferObjects\ResetPasswordDTOInterface;
use App\Http\Resources\Factories\PasswordResetResourceFactoryInterface;
use App\Http\Resources\PasswordResetResource;
use App\Models\Factories\PasswordResetModelFactoryInterface;
use App\Repositories\PasswordResetRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Hashing\HashManager;
use Psr\Log\LoggerInterface;

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
     * @var HashManager
     */
    private HashManager $hashManager;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * PasswordResetManager constructor.
     * @param PasswordResetModelFactoryInterface $passwordResetModelFactory
     * @param PasswordResetResourceFactoryInterface $passwordResetResourceFactory
     * @param UserRepositoryInterface $userRepository
     * @param PasswordResetRepositoryInterface $passwordResetRepository
     * @param HashManager $hashManager
     * @param LoggerInterface $logger
     */
    public function __construct(
        PasswordResetModelFactoryInterface $passwordResetModelFactory,
        PasswordResetResourceFactoryInterface $passwordResetResourceFactory,
        UserRepositoryInterface $userRepository,
        PasswordResetRepositoryInterface $passwordResetRepository,
        HashManager $hashManager,
        LoggerInterface $logger
    ) {
        $this->passwordResetModelFactory = $passwordResetModelFactory;
        $this->passwordResetResourceFactory = $passwordResetResourceFactory;
        $this->userRepository = $userRepository;
        $this->passwordResetRepository = $passwordResetRepository;
        $this->hashManager = $hashManager;
        $this->logger = $logger;
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

    /**
     * @inheritDoc
     */
    public function reset(ResetPasswordDTOInterface $resetPasswordDTO): void
    {
        $resetPassword = $this->passwordResetRepository->findByToken($resetPasswordDTO->getToken());
        $user = $this->userRepository->findByEmail($resetPassword->email);

        $user->password = $this->hashManager->make($resetPasswordDTO->getPassword());
        $user->save();

        $this->logger->info(
            sprintf('Password of user "%s" was changed.', $user->name)
        );
    }
}
