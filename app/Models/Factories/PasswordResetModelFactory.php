<?php

declare(strict_types=1);

namespace App\Models\Factories;

use App\Models\PasswordResetModel;

class PasswordResetModelFactory implements PasswordResetModelFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(string $email): PasswordResetModel
    {
        return new PasswordResetModel(
            [
                'email' => $email,
                'token' => hash_hmac('sha256', $email, $email),
                'created_at' => new \DateTime(),
            ]
        );
    }
}
