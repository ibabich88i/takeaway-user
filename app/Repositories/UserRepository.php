<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\UserModel;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var UserModel
     */
    private UserModel $model;

    /**
     * UserRepository constructor.
     * @param UserModel $model
     */
    public function __construct(UserModel $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function findByEmail(string $email): Model
    {
        $query = $this->model->newQuery();

        $query->where('email', $email);

        return $query->first();
    }
}
