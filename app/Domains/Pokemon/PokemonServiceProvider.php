<?php namespace App\Domains\Pokemon;

use App\Models\Dislike;
use App\Models\Favorite;
use App\Models\Like;
use Illuminate\Support\ServiceProvider;

class PokemonServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PokemonService::class, function () {
            return new PokemonService(
                new Like,
                new Dislike,
                new Favorite
            );
        });
    }
}