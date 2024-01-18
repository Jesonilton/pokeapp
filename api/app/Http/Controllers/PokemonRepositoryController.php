<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Exceptions\NotFoundException;
use App\Services\FavoritePokemonService;
use App\Services\PokemonRepositoryService;

class PokemonRepositoryController extends Controller
{
    /**
     * Controller constructor.
     * @param PokemonRepositoryService $pokemonRepositoryService
     */
    public function __construct(PokemonRepositoryService $pokemonRepositoryService, FavoritePokemonService $favoritePokemonService)
    {
        $this->pokemonRepositoryService = $pokemonRepositoryService;
        $this->favoritePokemonService = $favoritePokemonService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $filters
     * @return \Illuminate\Http\Response HTTP_OK - https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/200
     */
    public function index(Request $filters)
    {
        $data = $this->pokemonRepositoryService->getAll($filters->get('page', 1));

        return response($data, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response HTTP_OK - https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/200
     */
    public function show($pokemonName)
    {
        try {
            $pokemon = $this->pokemonRepositoryService->findByName($pokemonName)->toArray();
            $pokemon['favorite'] = $this->favoritePokemonService->existsByName($pokemonName);

            return response($pokemon, Response::HTTP_OK);
        } catch (NotFoundException $e) {
            return response(['message'=> 'Não concontrado'], Response::HTTP_NOT_FOUND);
        } 
        catch (\Exception $e) {
            return response(['message' => 'Erro interno no servidor'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
