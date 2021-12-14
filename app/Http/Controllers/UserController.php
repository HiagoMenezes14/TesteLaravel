<?php 

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domains\Service\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateUserRequest;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
      $this->userService = $userService; 
    }

    public function createUser(CreateUserRequest $request):JsonResponse
    {
        $usuario = $request->all();
        $this->userService->createUser($usuario);
        return response()->json($usuario);
    }
}