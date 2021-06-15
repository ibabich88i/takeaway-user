<?php

declare(strict_types=1);

namespace Tests\Unit\DataTransferObjects\Factories;

use App\DataTransferObjects\Factories\UserStoreDTOFactory;
use App\DataTransferObjects\UserStoreDTOInterface;
use PHPUnit\Framework\TestCase;

class UserStoreDTOFactoryTest extends TestCase
{
    /**
     * @var UserStoreDTOFactory
     */
    private UserStoreDTOFactory $userStoreDTOFactory;

    protected function setUp(): void
    {
        $this->userStoreDTOFactory = new UserStoreDTOFactory();
    }

    public function testCreateSuccess()
    {
        $result = $this->userStoreDTOFactory->create(
            [
                'name' => '',
                'email' => '',
                'password' => '',
            ]
        );

        $this->assertInstanceOf(UserStoreDTOInterface::class, $result);
    }
}
