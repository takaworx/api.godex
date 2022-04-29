<?php

namespace App\Http\Controllers;

use App\Domains\Pokemon\PokemonService;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    private $pokemonService;

    public function __construct(PokemonService $pokemonService)
    {
        $this->pokemonService = $pokemonService;
    }

    public function like(Request $request)
    {
        try {
            $this->pokemonService->like(
                $request->user()->id,
                $request->input('pokemon_id')
            );
        } catch (\Exception $e) {
            return $this->response()->badRequest(null, $e->getMessage());
        }

        return $this->response()->success($request->user()->fresh());
    }

    public function dislike(Request $request)
    {
        try {
            $this->pokemonService->dislike(
                $request->user()->id,
                $request->input('pokemon_id')
            );
        } catch (\Exception $e) {
            return $this->response()->badRequest(null, $e->getMessage());
        }

        return $this->response()->success($request->user()->fresh());
    }

    public function favorite(Request $request)
    {
        try {
            $this->pokemonService->favorite(
                $request->user()->id,
                $request->input('pokemon_id')
            );
        } catch (\Exception $e) {
            return $this->response()->badRequest(null, $e->getMessage());
        }

        return $this->response()->success($request->user()->fresh());
    }
}
