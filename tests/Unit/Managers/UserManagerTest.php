<?php

declare(strict_types=1);

namespace Tests\Unit\Managers;

use App\DataTransferObjects\UserStoreDTOInterface;
use App\Http\Resources\Factories\UserResourceFactoryInterface;
use App\Http\Resources\UserResource;
use App\Managers\UserManager;
use App\Models\Factories\UserModelFactoryInterface;
use App\Models\UserModel;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class UserManagerTest extends TestCase
{
    /**
     * @var MockObject|LoggerInterface
     */
    private MockObject $logger;
    /**
     * @var UserModelFactoryInterface|MockObject
     */
    private MockObject $userModelFactory;
    /**
     * @var UserResourceFactoryInterface|MockObject
     */
    private MockObject $userResourceFactory;
    /**
     * @var UserManager
     */
    private UserManager $userManager;

    protected function setUp(): void
    {
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->userModelFactory = $this->createMock(UserModelFactoryInterface::class);
        $this->userResourceFactory = $this->createMock(UserResourceFactoryInterface::class);

        $this->userManager = new UserManager(
            $this->logger,
            $this->userModelFactory,
            $this->userResourceFactory
        );
    }

    public function testStoreSuccess()
    {
        $userStoreDTO = $this->createMock(UserStoreDTOInterface::class);
        $userModel = $this->createMock(UserModel::class);
        $userResource = $this->createMock(UserResource::class);

        $this->userModelFactory
            ->expects($this->once())
            ->method('create')
            ->with($userStoreDTO)
            ->willReturn($userModel);

        $userModel
            ->expects($this->once())
            ->method('save');
        $userModel
            ->expects($this->exactly(2))
            ->method('__get')
            ->withConsecutive(['name'], ['email'])
            ->willReturn('');

        $this->logger
            ->expects($this->once())
            ->method('info');

        $this->userResourceFactory
            ->expects($this->once())
            ->method('create')
            ->with($userModel)
            ->willReturn($userResource);

        $result = $this->userManager->store($userStoreDTO);

        $this->assertInstanceOf(UserResource::class, $result);
    }
}
