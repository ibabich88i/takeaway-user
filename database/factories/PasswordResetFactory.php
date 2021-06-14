<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PasswordResetModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PasswordResetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PasswordResetModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'token' => $this->faker->unique()->text,
            'created_at' => new \DateTime()
        ];
    }
}
