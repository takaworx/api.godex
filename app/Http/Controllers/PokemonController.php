<?php

namespace App\Http\Controllers;

use App\Repositories\PokemonRepository;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    private $pokemonRepository;

    public function __construct(PokemonRepository $pokemonRepository)
    {
        $this->pokemonRepository = $pokemonRepository;
    }

    public function like(Request $request)
    {
        try {
            $this->pokemonRepository->like(
                $request->user()->id,
                $request->input('pokemon_id')
            );
        } catch (\Exception $e) {
            return $this->response()->badRequest($e->getMessage());
        }

        return $this->response()->success($request->user()->fresh());
    }

    public function dislike(Request $request)
    {
        try {
            $this->pokemonRepository->dislike(
                $request->user()->id,
                $request->input('pokemon_id')
            );
        } catch (\Exception $e) {
            return $this->response()->badRequest($e->getMessage());
        }

        return $this->response()->success($request->user()->fresh());
    }

    public function favorite(Request $request)
    {
        try {
            $this->pokemonRepository->favorite(
                $request->user()->id,
                $request->input('pokemon_id')
            );
        } catch (\Exception $e) {
            return $this->response()->badRequest($e->getMessage());
        }

        return $this->response()->success($request->user()->fresh());
    }
}
