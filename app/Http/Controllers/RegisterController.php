<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Repositories\RegisterRepository;

class RegisterController extends Controller
{
    private $registerRepo;

    public function __construct(RegisterRepository $registerRepo)
    {
        $this->registerRepo = $registerRepo;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->registerRepo->register(
                $request->input('first_name'),
                $request->input('last_name'),
                $request->input('email'),
                $request->input('password')
            );
        } catch (\Throwable $e) {
            return $this->response()->unexpectedError(null, $e->getMessage());
        }

        return $this->response()->success($user);
    }
}
