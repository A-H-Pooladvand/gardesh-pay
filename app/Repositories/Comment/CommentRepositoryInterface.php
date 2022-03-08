<?php

namespace App\Repositories\Comment;

/**
 * @mixin \App\Repositories\EloquentRepositoryInterface
 */
interface CommentRepositoryInterface
{
    /**
     * Gets paginated comments of a post.
     *
     * @param $commentableId
     * @param $commentableType
     * @return mixed
     */
    public function commentsOf($commentableId, $commentableType);
}
