<?php namespace App\Repositories;

use App\Models\User;

class RegisterRepository
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register($first_name, $last_name, $email, $password)
    {
        $user = $this->user->newInstance();
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->password = $password;
        $user->save();

        return $user;
    }
}