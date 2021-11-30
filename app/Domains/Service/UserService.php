<?php

namespace App\Domains\Service;

use App\Domains\Repositories\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
      $this->userRepository = $userRepository; 
    }

    public function createUser(array $usuario)
    {
        $this->userRepository->create($usuario);
    }

}