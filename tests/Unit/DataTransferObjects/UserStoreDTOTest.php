<?php

declare(strict_types=1);

namespace Tests\Unit\DataTransferObjects;

use App\DataTransferObjects\UserStoreDTO;
use PHPUnit\Framework\TestCase;

class UserStoreDTOTest extends TestCase
{
    public function testHandlingSuccess()
    {
        $name = '';
        $email = '';
        $password = '';

        $userStoreDTO = new UserStoreDTO($name, $email, $password);

        $this->assertEquals($name, $userStoreDTO->getName());
        $this->assertEquals($email, $userStoreDTO->getEmail());
        $this->assertEquals($password, $userStoreDTO->getPassword());
    }
}
