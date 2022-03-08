<?php

namespace App\Http\Controllers\Api\Post;

use Illuminate\Http\Request;
use App\Exceptions\NotFoundException;
use App\Repositories\Post\PostRepositoryInterface;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;
use App\Repositories\Comment\CommentRepositoryInterface;

class PostController
{
    use ProvidesConvenienceMethods;

    /**
     * Post Repository.
     *
     * @var \App\Repositories\Post\PostRepositoryInterface
     */
    private PostRepositoryInterface $postRepository;

    /**
     * Comment Repository.
     *
     * @var \App\Repositories\Comment\CommentRepositoryInterface
     */
    private CommentRepositoryInterface $commentRepository;

    public function __construct(
        PostRepositoryInterface $postRepository,
        CommentRepositoryInterface $commentRepository
    ) {
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
    }

    /**
     * Posts list resource.
     *
     * @return mixed
     */
    public function index()
    {
        return responder()->paginate(
            $this->postRepository->paginate()
        );
    }

    /**
     * @throws \App\Exceptions\NotFoundException
     */
    public function show($id)
    {
        $post = $this->postRepository->find($id);

        if (is_null($post)) {
            throw new NotFoundException();
        }

        $comments = $this->commentRepository->commentsOf($post->id, get_class($post));

        return responder()->ok([
            'data' => [
                'post'     => $post,
                'comments' => responder()->paginate($comments),
            ],
        ]);
    }

    /**
     * Creates a post.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'   => 'required|max:190|min:5',
            'content' => 'required|max:300000|min:10',
            'status'  => 'required|in:draft,publish',
        ]);

        $posts = $this->postRepository->create([
            'title'   => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return responder()->ok([
            'posts' => $posts,
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
        $this->postRepository->delete($id);

        return responder()->noContent();
    }

    /**
     * Delete a post.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $attributes = $this->validate($request, [
            'title'   => 'required|max:190|min:5',
            'content' => 'required|max:300000|min:10',
            'status'  => 'required|in:draft,publish',
        ]);

        $this->postRepository->update($id, $attributes);

        return responder()->noContent();
    }
}
