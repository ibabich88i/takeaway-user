<?php

declare(strict_types=1);

namespace App\Managers;

use App\DataTransferObjects\ResetPasswordDTOInterface;
use App\Http\Resources\PasswordResetResource;

interface PasswordResetManagerInterface
{
    /**
     * @param string $email
     * @return PasswordResetResource
     */
    public function forgot(string $email): PasswordResetResource;

    /**
     * @param ResetPasswordDTOInterface $resetPasswordDTO
     * @return void
     */
    public function reset(ResetPasswordDTOInterface $resetPasswordDTO): void;
}
