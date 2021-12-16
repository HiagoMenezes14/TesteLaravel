<?php 

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domains\Service\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Response;

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
      try {
        $usuario = $this->userService->createUser($usuario);
      } catch(\Exception $e) {
        return response()->json([
          'message' => $e->getMessage()
        ], Response::HTTP_BAD_REQUEST);
      }
        return response()->json(['message'=> 'Usuario cadastrado com sucesso' ,'data' => $usuario], Response::HTTP_OK);
    }
}