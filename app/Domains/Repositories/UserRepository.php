<?php

declare(strict_type=1);

namespace App\Domains\Repositories;

use App\Models\User;

class UserRepository extends RepositoryAbstract
{
    protected $model = User::class;

    public function model() {
        return $this->model;
    }

}