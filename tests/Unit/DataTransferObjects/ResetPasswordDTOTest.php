<?php

declare(strict_types=1);

namespace Tests\Unit\DataTransferObjects;

use App\DataTransferObjects\ResetPasswordDTO;
use PHPUnit\Framework\TestCase;

class ResetPasswordDTOTest extends TestCase
{
    public function testHandlingSuccess()
    {
        $token = '';
        $password = '';

        $resetPasswordDTO = new ResetPasswordDTO($token, $password);

        $this->assertEquals($token, $resetPasswordDTO->getToken());
        $this->assertEquals($password, $resetPasswordDTO->getPassword());
    }
}
