<?php namespace App\Entities;

use Illuminate\Support\Facades\DB;

class PassportHelper
{
    public function getPasswordClient()
    {
        $client = DB::table('oauth_clients')
            ->where('password_client', 1)
            ->first();

        if (is_null($client)) {
            return $client;
        }

        return json_decode(json_encode($client), true);
    }
}