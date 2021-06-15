<?php

declare(strict_types=1);

namespace Tests\Unit\Managers;

use App\DataTransferObjects\ResetPasswordDTOInterface;
use App\Http\Resources\Factories\PasswordResetResourceFactoryInterface;
use App\Http\Resources\PasswordResetResource;
use App\Managers\PasswordResetManager;
use App\Models\Factories\PasswordResetModelFactoryInterface;
use App\Models\PasswordResetModel;
use App\Models\UserModel;
use App\Repositories\PasswordResetRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Hashing\HashManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class PasswordResetManagerTest extends TestCase
{
    /**
     * @var PasswordResetModelFactoryInterface|MockObject
     */
    private MockObject $passwordResetModelFactory;

    /**
     * @var PasswordResetResourceFactoryInterface|MockObject
     */
    private MockObject $passwordResetResourceFactory;
    /**
     * @var UserRepositoryInterface|MockObject
     */
    private MockObject $userRepository;
    /**
     * @var PasswordResetRepositoryInterface|MockObject
     */
    private MockObject $passwordResetRepository;
    /**
     * @var HashManager|MockObject
     */
    private MockObject $hashManager;
    /**
     * @var MockObject|LoggerInterface
     */
    private MockObject $logger;
    /**
     * @var PasswordResetManager
     */
    private PasswordResetManager $passwordResetManager;

    protected function setUp(): void
    {
        $this->passwordResetModelFactory = $this->createMock(PasswordResetModelFactoryInterface::class);
        $this->passwordResetResourceFactory = $this->createMock(PasswordResetResourceFactoryInterface::class);
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
        $this->passwordResetRepository = $this->createMock(PasswordResetRepositoryInterface::class);
        $this->hashManager = $this->createMock(HashManager::class);
        $this->logger = $this->createMock(LoggerInterface::class);

        $this->passwordResetManager = new PasswordResetManager(
            $this->passwordResetModelFactory,
            $this->passwordResetResourceFactory,
            $this->userRepository,
            $this->passwordResetRepository,
            $this->hashManager,
            $this->logger
        );
    }

    public function testForgotSuccess()
    {
        $email = '';
        $passwordResetModel = $this->createMock(PasswordResetModel::class);
        $passwordResetResource = $this->createMock(PasswordResetResource::class);

        $this->passwordResetModelFactory
            ->expects($this->once())
            ->method('create')
            ->with($email)
            ->willReturn($passwordResetModel);

        $passwordResetModel
            ->expects($this->once())
            ->method('save');

        $this->passwordResetResourceFactory
            ->expects($this->once())
            ->method('create')
            ->with($passwordResetModel)
            ->willReturn($passwordResetResource);

        $result = $this->passwordResetManager->forgot($email);

        $this->assertInstanceOf(PasswordResetResource::class, $result);
    }

    public function testResetSuccess()
    {
        $resetPasswordDTO = $this->createMock(ResetPasswordDTOInterface::class);
        $passwordResetModel = $this->createMock(PasswordResetModel::class);
        $userModel = $this->createMock(UserModel::class);

        $resetPasswordDTO->expects($this->once())
            ->method('getToken')
            ->willReturn('');
        $resetPasswordDTO->expects($this->once())
            ->method('getPassword')
            ->willReturn('');

        $this->passwordResetRepository
            ->expects($this->once())
            ->method('findByToken')
            ->with('')
            ->willReturn($passwordResetModel);

        $passwordResetModel
            ->expects($this->once())
            ->method('__get')
            ->with('email')
            ->willReturn('');

        $this->userRepository
            ->expects($this->once())
            ->method('findByEmail')
            ->with()
            ->willReturn($userModel);

        $this->hashManager
            ->expects($this->once())
            ->method('make')
            ->with('')
            ->willReturn('');

        $userModel
            ->expects($this->once())
            ->method('save');
        $userModel
            ->expects($this->once())
            ->method('__get')
            ->with('name')
            ->willReturn('');

        $this->logger
            ->expects($this->once())
            ->method('info');

        $this->passwordResetManager->reset($resetPasswordDTO);
    }
}
