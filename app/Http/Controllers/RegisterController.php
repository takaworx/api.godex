<?php

namespace App\Http\Controllers;

use App\Domains\Register\RegisterService;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    private $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->registerService->register(
                $request->input('email'),
                $request->input('password')
            );
        } catch (\Throwable $e) {
            return $this->response()->unexpectedError(null, $e->getMessage());
        }

        return $this->response()->success($user);
    }
}
