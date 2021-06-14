<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\PasswordResetModel;
use Illuminate\Database\Eloquent\Model;

class PasswordResetRepository implements PasswordResetRepositoryInterface
{
    /**
     * @var PasswordResetModel
     */
    private PasswordResetModel $model;

    /**
     * PasswordResetRepository constructor.
     * @param PasswordResetModel $model
     */
    public function __construct(PasswordResetModel $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function findByToken(string $token): Model
    {
        $query = $this->model->newQuery();

        $query->where('token', $token);

        return $query->first();
    }
}
