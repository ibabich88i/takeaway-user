<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\PasswordResetModel;
use Illuminate\Database\Eloquent\Model;

interface PasswordResetRepositoryInterface
{
    /**
     * @param string $token
     * @return Model|PasswordResetModel
     */
    public function findByToken(string $token): Model;
}
