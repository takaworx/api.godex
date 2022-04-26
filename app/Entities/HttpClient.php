<?php namespace App\Entities;

use Illuminate\Support\Facades\Http;

class HttpClient
{
    public function get($url)
    {
        return Http::get($url);
    }

    public function post($url, array $form_params)
    {
        return Http::post($url, $form_params);
    }
}