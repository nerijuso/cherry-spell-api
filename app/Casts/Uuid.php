<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class Uuid implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        return $value ? \Ramsey\Uuid\Uuid::fromBytes($value)->toString() : null;
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        return \Ramsey\Uuid\Uuid::fromString($value)->getBytes();
    }
}
