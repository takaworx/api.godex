<?php namespace App\Domains\Register;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class RegisterServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(RegisterService::class, function () {
            return new RegisterService(
                new User
            );
        });
    }
}