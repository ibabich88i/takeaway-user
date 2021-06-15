<?php

declare(strict_types=1);

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\UserResetPasswordRequest;
use PHPUnit\Framework\TestCase;

class UserResetPasswordRequestTest extends TestCase
{
    /**
     * @var UserResetPasswordRequest
     */
    private UserResetPasswordRequest $request;

    protected function setUp(): void
    {
        $this->request = new UserResetPasswordRequest();
    }

    public function testAuthorizeSuccess()
    {
        $this->assertTrue($this->request->authorize());
    }

    public function testRulesSuccess()
    {
        $this->assertEquals(
            [
                'token' => ['required', 'string', 'exists:App\Models\PasswordResetModel,token'],
                'password' => ['required', 'min:6'],
                'passwordConfirmation' => ['required', 'same:password'],
            ],
            $this->request->rules()
        );
    }
}
