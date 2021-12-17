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

  public function validateEmail($email)
  {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      throw new \Exception("Essse email '$email' não é valido!!!"); 
    }
  }

  public function createUser(array $users): array
  {
    $email = data_get($users, 'email');
    $this->validateEmail($email);

    $collection = $this->userRepository->getUserByEmail($email);
    
    if (!$collection instanceof stdClass) {
      return $this->userRepository->create($users)->toArray();
    }
    throw new \Exception('Email existente, cadastre um novo e-mail');
  }
}
