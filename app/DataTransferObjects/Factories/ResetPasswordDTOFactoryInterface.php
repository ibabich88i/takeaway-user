<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Factories;

use App\DataTransferObjects\ResetPasswordDTOInterface;

interface ResetPasswordDTOFactoryInterface
{
    /**
     * @param array $data
     * @return ResetPasswordDTOInterface
     */
    public function create(array $data): ResetPasswordDTOInterface;
}
