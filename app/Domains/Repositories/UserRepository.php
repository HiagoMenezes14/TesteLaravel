<?php

namespace App\Domains\Repositories;

use App\Domains\Repositories; 
use App\Models\User;

class UserRepository extends RepositoryAbstract
{
    protected $model = User::class;

    public function model() {
        return $this->model;
    }

}