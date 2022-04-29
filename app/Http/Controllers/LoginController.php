<?php

namespace App\Http\Controllers;

use App\Domains\Login\LoginService;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request)
    {
        $result = $this->loginService->login(
            $request->input('email'),
            $request->input('password')
        );

        if ($result instanceof \Exception) {
            return $this->response()->badRequest([
                'email' => $result->getMessage()
            ]);
        }

        return $this->response()->success($result);
    }
}
