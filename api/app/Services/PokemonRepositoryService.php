<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Exceptions\NotFoundException;
use App\Services\Support\PokemonResponse;
use App\Services\Support\PokemonDataContract;
use App\Services\Support\PokemonRepositoryFilter;

class PokemonRepositoryService
{
    private $guzzleHttpClient;

    public function __construct()
    {
        $this->guzzleHttpClient = new Client(['verify' => __DIR__."/../SSLCertificate/cacert.pem"]);
    }

    public function findByName($name): PokemonDataContract
    {
        try {
            return PokemonResponse::createFromApiResponse($this->get("/$name"));
        } catch (\Exception $e) {
            if($e->getCode() == 404) {
                throw new NotFoundException("Pokemon not found", 1);
            }
            
            throw new $e;            
        }
    }

    public function getAll(int $page)
    {
        //primeira página na api é 0. Para facilitar o entendimento externo, deixei solicitando page = 1
        $page --;

        if($page < 1) {
            $page = 0;
        }

        $limit = 50;
        $offset = $page * $limit;
        $query = http_build_query(['limit' => $limit, 'offset' => $offset]);
        $pokemons = $this->get("?$query");

        //A comunicação do front com a api de pokemons externa é via nossa api. Para o front devemos abstrair links de apis de terceiros
        $pokemons['next_page'] = $pokemons['next'] ?  $page + 1 : null;
        $pokemons['previous_page'] = $pokemons['previous'] ?  $page : null;
        unset($pokemons['next']);
        unset($pokemons['previous']);

        return $pokemons;
    }

    private function get(string $urlPath = '', array $params = [])
    {
        $response = $this->guzzleHttpClient->get("https://pokeapi.co/api/v2/pokemon/$urlPath", $params);
        $body = $response->getBody()->getContents();
        return $data = json_decode($body, true);
    }
}
