<?php namespace App\Repositories;

use App\Models\Dislike;
use App\Models\Favorite;
use App\Models\Like;

class PokemonRepository
{
    const MAX_LIKE = 3;
    const MAX_DISLIKE = 3;
    const MAX_FAVORITE = 3;

    private $like;
    private $dislike;
    private $favorite;

    public function __construct(Like $like, Dislike $dislike, Favorite $favorite)
    {
        $this->like = $like;
        $this->dislike = $dislike;
        $this->favorite = $favorite;
    }

    public function like($user_id, $pokemon_id)
    {
        $likes = $this->like
            ->newQuery()
            ->where('user_id', $user_id)
            ->get();

        $existing = $likes->first(function ($item) use ($pokemon_id) {
            return $item->pokemon_id === intval($pokemon_id);
        });

        if (!is_null($existing)) {
            return $this->remove($user_id, $pokemon_id, 'like');
        }

        if ($likes->count() >= self::MAX_LIKE) {
            throw new \Exception(__('pokemon.max_like_exceeded'));
        }

        $like = $this->like->newInstance();
        $like->user_id = $user_id;
        $like->pokemon_id = $pokemon_id;
        $like->save();

        return $like;
    }

    public function dislike($user_id, $pokemon_id)
    {
        $dislikes = $this->dislike
            ->newQuery()
            ->where('user_id', $user_id)
            ->get();

        $existing = $dislikes->first(function ($item) use ($pokemon_id) {
            return $item->pokemon_id === intval($pokemon_id);
        });
        
        if (!is_null($existing)) {
            return $this->remove($user_id, $pokemon_id, 'dislike');
        }

        if ($dislikes->count() >= self::MAX_DISLIKE) {
            throw new \Exception(__('pokemon.max_dislike_exceeded'));
        }

        $dislike = $this->dislike->newInstance();
        $dislike->user_id = $user_id;
        $dislike->pokemon_id = $pokemon_id;
        $dislike->save();

        return $dislike;
    }

    public function favorite($user_id, $pokemon_id)
    {
        $favorites = $this->favorite
            ->newQuery()
            ->where('user_id', $user_id)
            ->get();

        $existing = $favorites->first(function ($item) use ($pokemon_id) {
            return $item->pokemon_id === intval($pokemon_id);
        });
        
        if (!is_null($existing)) {
            return $this->remove($user_id, $pokemon_id, 'favorite');
        }

        if ($favorites->count() >= self::MAX_FAVORITE) {
            throw new \Exception(__('pokemon.max_favorite_exceeded'));
        }

        $favorite = $this->favorite->newInstance();
        $favorite->user_id = $user_id;
        $favorite->pokemon_id = $pokemon_id;
        $favorite->save();

        return $favorite;
    }

    public function remove($user_id, $pokemon_id, $model)
    {
        return $this->{$model}
            ->newQuery()
            ->where('user_id', $user_id)
            ->where('pokemon_id', $pokemon_id)
            ->delete();
    }
}