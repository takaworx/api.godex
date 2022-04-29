<?php

namespace Tests\Unit;

use App\Domains\Pokemon\PokemonService;
use App\Models\Dislike;
use App\Models\Favorite;
use App\Models\Like;
use Exception;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class PokemonTest extends TestCase
{
    public function likeTestDataProvider()
    {
        return [
            'success' => [
                'pokemon_ids' => [1],
                'likes' => $this->generateLikes([1]), // pass pokemon_ids here as parameter
                'shouldRemoveLike' => false, // if user already liked the pokemon calling the function again should remove it
                'expected' => 'saved'
            ],
            'exceeded' => [
                'pokemon_ids' => [1,2,3],
                'likes' => $this->generateLikes([1,2,3]), // pass pokemon_ids here as parameter
                'shouldRemoveLike' => false, // if user already liked the pokemon calling the function again should remove it
                'expected' => 'exception'
            ],
            'remove' => [
                'pokemon_ids' => [1],
                'likes' => $this->generateLikes([1]), // pass pokemon_ids here as parameter
                'shouldRemoveLike' => true, // if user already liked the pokemon calling the function again should remove it
                'expected' => 'deleted'
            ]
        ];
    }

    public function dislikeTestDataProvider()
    {
        return [
            'success' => [
                'pokemon_ids' => [1],
                'likes' => $this->generateDislikes([1]), // pass pokemon_ids here as parameter
                'shouldRemoveLike' => false, // if user already disliked the pokemon calling the function again should remove it
                'expected' => 'saved'
            ],
            'exceeded' => [
                'pokemon_ids' => [1,2,3],
                'likes' => $this->generateDislikes([1,2,3]), // pass pokemon_ids here as parameter
                'shouldRemoveLike' => false, // if user already disliked the pokemon calling the function again should remove it
                'expected' => 'exception'
            ],
            'remove' => [
                'pokemon_ids' => [1],
                'likes' => $this->generateDislikes([1]), // pass pokemon_ids here as parameter
                'shouldRemoveLike' => true, // if user already disliked the pokemon calling the function again should remove it
                'expected' => 'deleted'
            ]
        ];
    }

    /**
     * @dataProvider likeTestDataProvider
     */
    public function testLikeFunction($pokemon_ids, $likes, $shouldRemoveLike, $expected)
    {
        $this->withoutExceptionHandling();

        $likeMock = Mockery::mock(Like::class, function (MockInterface $mock) use ($likes) {
            $mock->shouldReceive('newQuery')->andReturnSelf();
            $mock->shouldReceive('where')->andReturnSelf();
            $mock->shouldReceive('get')->andReturn($likes);
            $mock->shouldReceive('newInstance')->andReturn($this->createLikeInstance());
            $mock->shouldReceive('delete')->andReturn('deleted');
        });

        $service = new PokemonService($likeMock, new Dislike, new Favorite);

        $user_id = 1;
        
        do {
            $pokemon_id = random_int(1, 99);
        } while(in_array($pokemon_id, $pokemon_ids));

        if ($shouldRemoveLike) {
            $pokemon_id = $pokemon_ids[0];
        }

        try {
            $result = $service->like($user_id, $pokemon_id);

            if ($expected === 'saved') {
                $this->assertEquals(true, $result->saved);
            } else if ($expected === 'deleted') {
                $this->assertEquals($expected,  $result);
            }
        } catch (\Exception $e) {
            $this->assertEquals(__('pokemon.max_like_exceeded'), $e->getMessage());
        }
    }

    /**
     * @dataProvider dislikeTestDataProvider
     */
    public function testDislikeFunction($pokemon_ids, $likes, $shouldRemoveLike, $expected)
    {
        $this->withoutExceptionHandling();

        $likeMock = Mockery::mock(Like::class, function (MockInterface $mock) use ($likes) {
            $mock->shouldReceive('newQuery')->andReturnSelf();
            $mock->shouldReceive('where')->andReturnSelf();
            $mock->shouldReceive('get')->andReturn($likes);
            $mock->shouldReceive('newInstance')->andReturn($this->createLikeInstance());
            $mock->shouldReceive('delete')->andReturn('deleted');
        });

        $service = new PokemonService($likeMock, new Dislike, new Favorite);

        $user_id = 1;
        
        do {
            $pokemon_id = random_int(1, 99);
        } while(in_array($pokemon_id, $pokemon_ids));

        if ($shouldRemoveLike) {
            $pokemon_id = $pokemon_ids[0];
        }

        try {
            $result = $service->dislike($user_id, $pokemon_id);

            if ($expected === 'saved') {
                $this->assertEquals(true, $result->saved);
            } else if ($expected === 'deleted') {
                $this->assertEquals($expected,  $result);
            }
        } catch (\Exception $e) {
            $this->assertEquals(__('pokemon.max_dislike_exceeded'), $e->getMessage());
        }
    }

    private function generateLikes(array $ids)
    {
        $likes = [];

        for ($i = 0; $i < count($ids); $i++) {
            $like = $this->createLikeInstance();

            $like->pokemon_id = $ids[$i];

            $likes[] = $like;
        }

        return collect($likes);
    }

    private function generateDislikes(array $ids)
    {
        $dislikes = [];

        for ($i = 0; $i < count($ids); $i++) {
            $dislike = $this->createDislikeInstance();

            $dislike->pokemon_id = $ids[$i];

            $dislikes[] = $dislike;
        }

        return collect($dislikes);
    }

    private function createLikeInstance()
    {
        return new class {
            public $user_id;
            public $pokemon_id;
            public $saved = false;

            public function save()
            {
                return $this->saved = true;
            }
        };
    }

    private function createDislikeInstance()
    {
        return new class {
            public $user_id;
            public $pokemon_id;
            public $saved = false;

            public function save()
            {
                return $this->saved = true;
            }
        };
    }
}