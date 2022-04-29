<?php namespace App\Domains\Register;

use App\Models\User;

class RegisterService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register($email, $password)
    {
        $user = $this->user->newInstance();
        $user->email = $email;
        $user->password = $password;
        $user->save();

        return $user;
    }
}