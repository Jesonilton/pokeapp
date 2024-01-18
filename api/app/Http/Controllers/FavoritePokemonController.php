<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\FavoritePokemonService;
use App\Http\Controllers\Controller;
use App\Exceptions\NotFoundException;
use App\Exceptions\AlreadyExistsException;
use App\Http\Requests\StorePokemonRequest;
use App\Services\PokemonRepositoryService;
use App\Http\Requests\UpdatePokemonRequest;

class FavoritePokemonController extends Controller
{
    /**
     * @var \App\Services\FavoritePokemonService
     */
    private $favoritePokemonService;
    /**
     * @var \App\Services\PokemonRepositoryService
     */
    private $pokemonRepositoryService;

    /**
     * Controller constructor.
     * @param \App\Services\FavoritePokemonService $favoritePokemonService
     */
    public function __construct(FavoritePokemonService $favoritePokemonService, PokemonRepositoryService $pokemonRepositoryService)
    {
        $this->favoritePokemonService = $favoritePokemonService;
        $this->pokemonRepositoryService = $pokemonRepositoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $filters
     * @return \Illuminate\Http\Response HTTP_OK - https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/200
     */
    public function index(Request $filters)
    {
        $data = $this->favoritePokemonService->getAll($filters->toArray());

        return response($data, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePokemonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePokemonRequest $request)
    {
        try {
            $pokemon = $this->pokemonRepositoryService->findByName($request->get('name'));
            $pokemonRegister = $this->favoritePokemonService->create($pokemon);
            return response($pokemonRegister, Response::HTTP_CREATED);
        } catch (NotFoundException $e) {
            return response(['message'=> 'Não concontrado'], Response::HTTP_NOT_FOUND);
        } catch (AlreadyExistsException $e) {
            return response(['message'=> 'Pokemon já registrado'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response(['message' => 'Erro interno no servidor'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
            return response($this->favoritePokemonService->findByName($pokemonName), Response::HTTP_OK);
        } catch (NotFoundException $e) {
            return response(['message'=> 'Não concontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response(['message' => 'Erro interno no servidor'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response HTTP_OK - https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/200
     */
    public function destroy($name)
    {
        try {
            $this->favoritePokemonService->delete($name);
            return response(['message'=> 'Removido com sucesso', 'success' => true], Response::HTTP_OK);
        } catch (NotFoundException $e) {
            return response(['message'=> 'Não concontrado'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response(['message' => 'Erro interno no servidor'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
