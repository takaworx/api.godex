<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;    
    }

    public function user(Request $request)
    {
        if (!$request->user()) {
            return $this->response()->unauthorized();
        }

        return $this->response()->success($request->user());
    }

    public function update(UpdateRequest $request)
    {
        try {
            $result = $this->userRepo->update(
                $request->user()->id,
                $request->only([
                    'first_name',
                    'last_name',
                    'birthday',
                ])
            );
        } catch (\Exception $e) {
            return $this->response()->unexpectedError($e->getMessage());
        }

        return $this->response()->success($result);
    }

    public function paginate(Request $request)
    {
        try {
            $result = $this->userRepo->paginate([
                $request->user()->id
            ]);
        } catch (\Exception $e) {
            return $this->response()->unexpectedError($e->getMessage());
        }

        return $this->response()->success($result);
    }
}
