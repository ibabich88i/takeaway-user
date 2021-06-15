<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use App\Models\PasswordResetModel;
use App\Models\UserModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class PasswordResetControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testForgotSuccess()
    {
        $user = UserModel::factory()->create();

        $payload = [
            'email' => $user->email
        ];

        $url = route('password.forgot');

        $response = $this->post($url, $payload);

        $response->assertSuccessful();

        $data = json_decode($response->baseResponse->getContent(), true);
        $this->assertEquals(
            $data['token'],
            PasswordResetModel::query()->where('email', $user->email)->first()->token
        );
    }

    public function testForgotFailed()
    {
        $url = route('password.forgot');

        $response = $this->post($url, []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['email']);
    }

    public function testResetSuccess()
    {
        $user = UserModel::factory()->create();
        $passwordResetModel = PasswordResetModel::factory()->create(
            [
                'email' => $user->email
            ]
        );

        $payload = [
            'email' => $user->email
        ];

        $url = route('password.forgot');

        $userResponse = $this->post($url, $payload);
        $userResponse->assertSuccessful();

        $payload = [
            'token' => $passwordResetModel->token,
            'password' => '123secret123',
            'passwordConfirmation' => '123secret123',
        ];

        $url = route('password.reset');

        $response = $this->put($url, $payload);

        $response->assertSuccessful();
        $response->assertStatus(Response::HTTP_ACCEPTED);
    }

    public function testResetFailed()
    {
        $url = route('password.reset');

        $response = $this->put($url, []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['token', 'password', 'passwordConfirmation']);
    }
}
