<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user(Request $request)
    {
        if (!$request->user()) {
            return $this->response()->unauthorized();
        }

        return $this->response()->success($request->user());
    }
}
