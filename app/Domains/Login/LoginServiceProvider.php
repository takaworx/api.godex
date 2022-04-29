<?php namespace App\Domains\Login;

use App\Entities\HttpClient;
use App\Entities\PassportHelper;
use Illuminate\Support\ServiceProvider;

class LoginServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(LoginService::class, function () {
            return new LoginService(
                new HttpClient,
                new PassportHelper
            );
        });
    }
}