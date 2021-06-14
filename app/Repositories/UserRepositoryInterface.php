<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\UserModel;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    /**
     * @param string $email
     * @return UserModel|Model
     */
    public function findByEmail(string $email): Model;
}
