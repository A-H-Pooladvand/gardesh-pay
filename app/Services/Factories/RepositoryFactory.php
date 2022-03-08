<?php

namespace App\Services\Factories;

use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;

class RepositoryFactory
{
    public static function make($type):EloquentRepositoryInterface
    {
        return match ($type) {
            'post' => app(PostRepositoryInterface::class)
        };
    }
}
