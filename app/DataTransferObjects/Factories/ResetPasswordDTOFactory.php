<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Factories;

use App\DataTransferObjects\ResetPasswordDTO;
use App\DataTransferObjects\ResetPasswordDTOInterface;

class ResetPasswordDTOFactory implements ResetPasswordDTOFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(array $data): ResetPasswordDTOInterface
    {
        return new ResetPasswordDTO(
            $data['token'],
            $data['password'],
        );
    }
}
