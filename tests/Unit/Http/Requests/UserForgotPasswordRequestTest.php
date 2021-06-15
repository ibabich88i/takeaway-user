<?php

declare(strict_types=1);

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\UserForgotPasswordRequest;
use PHPUnit\Framework\TestCase;

class UserForgotPasswordRequestTest extends TestCase
{
    /**
     * @var UserForgotPasswordRequest
     */
    private UserForgotPasswordRequest $request;

    protected function setUp(): void
    {
        $this->request = new UserForgotPasswordRequest();
    }

    public function testAuthorizeSuccess()
    {
        $this->assertTrue($this->request->authorize());
    }

    public function testRulesSuccess()
    {
        $this->assertEquals(
            [
                'email' => ['required', 'email', 'exists:App\Models\UserModel,email'],
            ],
            $this->request->rules()
        );
    }
}
