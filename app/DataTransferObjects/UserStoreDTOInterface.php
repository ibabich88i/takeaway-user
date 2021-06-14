<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

interface UserStoreDTOInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @return string
     */
    public function getPassword(): string;
}
