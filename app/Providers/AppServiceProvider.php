<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Response\JsonResponse;
use App\Repositories\Post\PostRepository;
use App\Services\Response\ResponseInterface;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Comment\CommentRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(ResponseInterface::class, JsonResponse::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
    }
}
