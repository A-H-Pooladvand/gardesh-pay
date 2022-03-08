<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Repositories\BaseRepository;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function commentsOf($commentableId, $commentableType)
    {
        return $this->model->where([
            'commentable_id'   => $commentableId,
            'commentable_type' => $commentableType,
        ])->paginate();
    }
}
