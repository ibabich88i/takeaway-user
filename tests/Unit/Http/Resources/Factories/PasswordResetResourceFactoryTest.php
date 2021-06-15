<?php

declare(strict_types=1);

namespace Tests\Unit\Http\Resources\Factories;

use App\Http\Resources\Factories\PasswordResetResourceFactory;
use App\Http\Resources\PasswordResetResource;
use App\Models\PasswordResetModel;
use PHPUnit\Framework\TestCase;

class PasswordResetResourceFactoryTest extends TestCase
{
    /**
     * @var PasswordResetResourceFactory
     */
    private PasswordResetResourceFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new PasswordResetResourceFactory();
    }

    public function testCreateSuccess()
    {
        $model = $this->createMock(PasswordResetModel::class);

        $result = $this->factory->create($model);

        $this->assertInstanceOf(PasswordResetResource::class, $result);
    }
}
