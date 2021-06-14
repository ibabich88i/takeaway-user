<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

interface ResetPasswordDTOInterface
{
    /**
     * @return string
     */
    public function getToken(): string;

    /**
     * @return string
     */
    public function getPassword(): string;
}
