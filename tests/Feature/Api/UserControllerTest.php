<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use App\Models\UserModel;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreSuccess()
    {
        /** @var Generator $faker */
        $faker = $this->app->get(Generator::class);
        $payload = [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => $faker->text(10)
        ];

        $url = route('users.store');

        $response = $this->post($url, $payload);

        $response->assertSuccessful();
        $this->assertEquals(1, UserModel::query()->where('email', $payload['email'])->count());
    }

    public function testStoreFailed()
    {
        $url = route('users.store');

        $response = $this->post($url, []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['name', 'email', 'password']);
    }
}
