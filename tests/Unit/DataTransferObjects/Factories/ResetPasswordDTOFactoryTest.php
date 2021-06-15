<?php

declare(strict_types=1);

namespace Tests\Unit\DataTransferObjects\Factories;

use App\DataTransferObjects\Factories\ResetPasswordDTOFactory;
use App\DataTransferObjects\ResetPasswordDTOInterface;
use PHPUnit\Framework\TestCase;

class ResetPasswordDTOFactoryTest extends TestCase
{
    /**
     * @var ResetPasswordDTOFactory
     */
    private ResetPasswordDTOFactory $resetPasswordDTOFactory;

    protected function setUp(): void
    {
        $this->resetPasswordDTOFactory = new ResetPasswordDTOFactory();
    }

    public function testCreateSuccess()
    {
        $response = $this->resetPasswordDTOFactory->create(['token' => '', 'password' => '']);

        $this->assertInstanceOf(ResetPasswordDTOInterface::class, $response);
    }
}
