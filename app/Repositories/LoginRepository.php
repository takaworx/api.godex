<?php namespace App\Repositories;

use App\Entities\HttpClient;
use App\Entities\PassportHelper;

class LoginRepository
{
    private $http;
    private $client;

    public function __construct(HttpClient $http, PassportHelper $passportHelper)
    {
        $this->http = $http;
        $this->client = $passportHelper->getPasswordClient();
    }

    public function login($email, $password)
    {
        $response = $this->http->post(url('/oauth/token'), [
            'grant_type' => 'password',
            'client_id' => $this->client['id'],
            'client_secret' => $this->client['secret'],
            'username' => $email,
            'password' => $password,
            'scope' => '*'
        ]);

        if ($response->successful()) {
            return json_decode((string)$response->body(), true);
        }

        return new \Exception(__('auth.failed'));
    }
}