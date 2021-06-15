<?php

declare(strict_types=1);

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\UserResource;
use PHPUnit\Framework\TestCase;

class UserResourceTest extends TestCase
{
    public function testHandlingSuccess()
    {
        $data = [
            'id' => null,
            'email' => null,
            'name' => null,
        ];
        $passwordResetResource = new UserResource((object)$data);

        $this->assertEquals(
            [
                'id' => null,
                'email' => null,
                'name' => null,
            ],
            $passwordResetResource->toArray(null)
        );
    }
}
