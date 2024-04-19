<?php

namespace App\Services\Funnel;

use Illuminate\Support\Str;

abstract class FunnelPageType
{
    abstract public function getName(): string;

    abstract public function getResource($funnelPage): array;

    public function getID(): string
    {
        return Str::snake(class_basename($this));
    }

    public function getData(): array
    {
        return [];
    }
}
