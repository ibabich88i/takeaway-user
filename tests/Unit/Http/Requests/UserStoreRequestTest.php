<?php

declare(strict_types=1);

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\UserStoreRequest;
use PHPUnit\Framework\TestCase;

class UserStoreRequestTest extends TestCase
{
    /**
     * @var UserStoreRequest
     */
    private UserStoreRequest $request;

    protected function setUp(): void
    {
        $this->request = new UserStoreRequest();
    }

    public function testAuthorizeSuccess()
    {
        $this->assertTrue($this->request->authorize());
    }

    public function testRulesSuccess()
    {
        $this->assertEquals(
            [
                'name' => ['required', 'string'],
                'email' => ['required', 'email', 'unique:App\Models\UserModel,email'],
                'password' => ['required', 'min:6'],
            ],
            $this->request->rules()
        );
    }
}
