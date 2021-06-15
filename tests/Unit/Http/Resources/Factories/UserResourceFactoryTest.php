<?php

declare(strict_types=1);

namespace Tests\Unit\Http\Resources\Factories;

use App\Http\Resources\Factories\UserResourceFactory;
use App\Http\Resources\UserResource;
use App\Models\UserModel;
use Illuminate\Http\Resources\Json\JsonResource;
use PHPUnit\Framework\TestCase;

class UserResourceFactoryTest extends TestCase
{
    /**
     * @var UserResourceFactory
     */
    private UserResourceFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new UserResourceFactory();
    }

    public function testCreateSuccess()
    {
        $userModel = $this->createMock(UserModel::class);

        $result = $this->factory->create($userModel);

        $this->assertInstanceOf(UserResource::class, $result);
    }
}
