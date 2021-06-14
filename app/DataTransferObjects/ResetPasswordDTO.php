<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

class ResetPasswordDTO implements ResetPasswordDTOInterface
{
    /**
     * @var string
     */
    private string $token;

    /**
     * @var string
     */
    private string $password;

    /**
     * ResetPasswordDTO constructor.
     * @param string $token
     * @param string $password
     */
    public function __construct(string $token, string $password)
    {
        $this->token = $token;
        $this->password = $password;
    }

    /**
     * @inheritDoc
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @inheritDoc
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
