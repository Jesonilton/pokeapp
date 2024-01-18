<?php

namespace App\Services\Support;

use App\Services\Support\PokemonDataContract;

class PokemonResponse implements PokemonDataContract
{
    private string $name;
    private float $weight;
    private float $height;
    private array $types;
    private string $avatarUrl;

    public function __construct(string $name, float $weight, float $height, array $types, string $avatarUrl)
    {
        $this->name = $name;
        $this->weight = $weight;
        $this->height = $height;
        $this->types = $types;
        $this->avatarUrl = $avatarUrl;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getWeight() : float
    {
        return $this->weight;
    }

    public function getHeight() : float
    {
        return $this->height;
    }

    public function getTypes() : array
    {
        return $this->types;
    }

    public function getAvatarUrl() : string
    {
        return $this->avatarUrl;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
    
    public static function createFromApiResponse(array $pokemon)
    {
        $pokemon = collect($pokemon);
        $pokemon = $pokemon->only('name', 'weight', 'height', 'types', 'sprites');
        $types = collect($pokemon->get('types'))
                        ->pluck('type')
                        ->pluck('name')
                        ->toArray();

        return new self($pokemon->get('name'), $pokemon->get('weight'), $pokemon->get('height'), $types, $pokemon->get('sprites')['front_default']);
    }
}
