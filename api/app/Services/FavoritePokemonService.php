<?php

namespace App\Services;

use App\Models\Type;
use App\Models\Pokemon;
use Illuminate\Support\Facades\DB;
use App\Exceptions\NotFoundException;
use App\Exceptions\AlreadyExistsException;
use App\Services\Support\PokemonDataContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FavoritePokemonService
{
    protected $pokemonModel;
    protected $pokemonType;

    public function __construct(Pokemon $pokemonModel, Type $pokemonType)
    {
        $this->pokemonModel = $pokemonModel;
        $this->pokemonType = $pokemonType;
    }

    public function create(PokemonDataContract $pokemonData)
    {
        if($this->existsByName($pokemonData->getName())) {
            throw new AlreadyExistsException("Register already exists", 1);
        }

        if($this->existsDeletedByName($pokemonData->getName())) {
            return $this->restore($pokemonData->getName());
        }

        $typeIds = $this->getTypeIds($pokemonData->getTypes());

        return DB::transaction(function() use($typeIds, $pokemonData){
            $pokemonRegister = $this->pokemonModel->create([
                                    'name' => $pokemonData->getName(),
                                    'avatar' => $pokemonData->getAvatarUrl(),
                                    'weight' => $pokemonData->getWeight(),
                                    'height' => $pokemonData->getHeight()
                                ]);
    
            $pokemonRegister->types()->attach($typeIds);

            return $pokemonRegister;
        });
    }

    private function getTypeIds(array $types): array
    {
        return DB::transaction(function() use($types){
            $typeIds = [];

            foreach ($types as $key => $type) {
                $typeRegister = $this->pokemonType->firstOrCreate(['name' => $type]);
                $typeIds[] = $typeRegister->id;
            }

            return $typeIds;
        });
    }

    public function existsByName($name)
    {
        return $this->pokemonModel->where(DB::raw('lower(name)'), 'ilike', "%$name%")->exists();
    }

    public function existsDeletedByName($name)
    {
        return $this->pokemonModel->withTrashed()->where(DB::raw('lower(name)'), 'ilike', "%$name%")->restore();
    }

    public function restore($name)
    {
        return $this->pokemonModel->withTrashed()->where(DB::raw('lower(name)'), 'ilike', "%$name%")->exists();
    }

    public function findByName($name): Pokemon
    {
        try {
            $name = strtolower($name);
            return $this->pokemonModel->with('types')
                                    ->withCount('likes')
                                    ->where(DB::raw('lower(name)'), 'ilike', "%$name%")
                                    ->firstOrFail();
        } catch(ModelNotFoundException $e) {
            throw new NotFoundException("Pokemon not found", 1);
        }
    }

    public function getAll(array $filters)
    {
        return $this->pokemonModel->with('types')
                        ->withCount('likes')
                        ->where(function($query) use($filters){
                            if(!isset($filters['q'])) {
                                return $query;
                            }

                            $term = $filters['q'];
                            return $query->where(DB::raw('lower(name)'), 'ilike', "%$term%");
                        })
                        ->get();
    }

    public function delete($name)
    {
        if(!$this->existsByName($name)) {
            throw new NotFoundException("Pokemon not found", 1);
        }

        return DB::transaction(function() use($name) {
            return $this->pokemonModel->where(DB::raw('lower(name)'), 'ilike', "%$name%")->delete();
        });
    }
}
