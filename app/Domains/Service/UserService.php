<?php

declare(strict_types=1);

namespace App\Domains\Service;

use App\Domains\Repositories\UserRepository;
use App\Models\User;
use stdClass;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
      $this->userRepository = $userRepository; 
    }

    public function createUser(array $users): array
    {
      $email = data_get($users, 'email');
      $collection = $this->userRepository->getUserByEmail($email);

      if(!$collection instanceof stdClass) {
        return $this->userRepository->create($users)->toArray();
      }

      throw new \Exception('Email existente, cadastre um novo e-mail');
    }
}