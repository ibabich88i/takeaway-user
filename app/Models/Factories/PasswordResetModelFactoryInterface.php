<?php

declare(strict_types=1);

namespace App\Models\Factories;

use App\Models\PasswordResetModel;

interface PasswordResetModelFactoryInterface
{
    /**
     * @param string $email
     * @return PasswordResetModel
     */
    public function create(string $email): PasswordResetModel;
}
