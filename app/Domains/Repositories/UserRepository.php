<?php

declare(strict_type=1);

namespace App\Domains\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository extends RepositoryAbstract
{
    protected $model = User::class;

    public function model() {
        return $this->model;
    }

    public function getUserByEmail($email) {
        return DB::table('users')
                ->where('email', '=', $email)
                ->first();
    }

}