<?php namespace App\Domains\User;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserService::class, function () {
            return new UserService(
                new User
            );
        });
    }
}