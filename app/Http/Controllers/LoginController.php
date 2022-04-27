<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Repositories\LoginRepository;

class LoginController extends Controller
{
    private $loginRepo;

    public function __construct(LoginRepository $loginRepo)
    {
        $this->loginRepo = $loginRepo;
    }

    public function login(LoginRequest $request)
    {
        $result = $this->loginRepo->login(
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
