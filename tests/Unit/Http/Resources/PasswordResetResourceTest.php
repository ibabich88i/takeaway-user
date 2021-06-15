<?php

declare(strict_types=1);

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\PasswordResetResource;
use PHPUnit\Framework\TestCase;

class PasswordResetResourceTest extends TestCase
{
    public function testHandlingSuccess()
    {
        $passwordResetResource = new PasswordResetResource((object)['token' => null]);

        $this->assertEquals(
            [
                'token' => null,
            ],
            $passwordResetResource->toArray(null)
        );
    }
}
