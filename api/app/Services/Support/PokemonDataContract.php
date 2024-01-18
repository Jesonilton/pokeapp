<?php

namespace App\Services\Support;

interface PokemonDataContract
{
    public function getName(): string;

    public function getWeight() : float;

    public function getHeight() : float;

    public function getTypes() : array;

    public function getAvatarUrl() : string;

    public function toArray(): array;
}