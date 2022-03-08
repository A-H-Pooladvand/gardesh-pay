<?php

namespace App\Http\Controllers\Api\Comment;

use Illuminate\Http\Request;
use App\Exceptions\NotFoundException;
use App\Services\Factories\RepositoryFactory;
use App\Repositories\Post\PostRepositoryInterface;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;
use App\Repositories\Comment\CommentRepositoryInterface;

class CommentController
{
    use ProvidesConvenienceMethods;

    /**
     * Comment Repository.
     *
     * @var \App\Repositories\Comment\CommentRepositoryInterface
     */
    private CommentRepositoryInterface $commentRepository;

    public function __construct(
        CommentRepositoryInterface $commentRepository
    ) {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Creates a post.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'content'          => 'required|max:190|min:5',
            'commentable_id'   => 'required',
            'commentable_type' => 'required|in:post',
        ]);

        $repository = RepositoryFactory::make($request->input('commentable_type'));

        $commentable = $repository->find($request->input('commentable_id'));

        if (is_null($commentable)) {
            return throw new NotFoundException();
        }

        $comment = $this->commentRepository->create($attributes);

        return responder()->ok([
            'comment' => $comment,
        ]);
    }

    /**
     * Delete a post.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return mixed
     * @throws \App\Exceptions\NotFoundException
     */
    public function update(Request $request, $id)
    {
        $comment = $this->commentRepository->find($id);

        if (is_null($comment)) {
            throw new NotFoundException();
        }

        $attributes = $this->validate($request, [
            'content'          => 'required|max:190|min:5',
            'commentable_id'   => 'required',
            'commentable_type' => 'required|in:post',
        ]);

        $repository = RepositoryFactory::make($request->input('commentable_type'));

        $commentable = $repository->find($request->input('commentable_id'));

        if (is_null($commentable)) {
            throw new NotFoundException();
        }

        $this->commentRepository->update($comment->id, $attributes);

        return responder()->ok([
            'comment' => $comment,
        ]);
    }

    /**
     * Delete a post.
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->commentRepository->delete($id);

        return responder()->noContent();
    }
}
