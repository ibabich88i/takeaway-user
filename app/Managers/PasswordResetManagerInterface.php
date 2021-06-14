<?php

declare(strict_types=1);

namespace App\Managers;

use App\Http\Resources\PasswordResetResource;

interface PasswordResetManagerInterface
{
    /**
     * @param string $email
     * @return PasswordResetResource
     */
    public function forgot(string $email): PasswordResetResource;
}
