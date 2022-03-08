<?php

namespace App\Services\Response;

use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

class JsonResponse implements ResponseInterface
{
    /**
     * 200 HTTP status code which may contains some data.
     *
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function ok($data = [])
    {
        return $this->response(Response::HTTP_OK, $data);
    }

    /**
     * Determines pagination data.
     *
     * @param \Illuminate\Pagination\LengthAwarePaginator $paginator
     * @return mixed
     */
    public function paginate(LengthAwarePaginator $paginator)
    {
        return $this->ok([
            'data' => $paginator->items(),
            'meta' => [
                'current_page'   => $paginator->currentPage(),
                'first_page_url' => $paginator->url(1),
                'from'           => $paginator->firstItem(),
                'last_page'      => $paginator->lastPage(),
                'last_page_url'  => $paginator->url($paginator->lastPage()),
                'links'          => $paginator->linkCollection()->toArray(),
                'next_page_url'  => $paginator->nextPageUrl(),
                'path'           => $paginator->path(),
                'per_page'       => $paginator->perPage(),
                'prev_page_url'  => $paginator->previousPageUrl(),
                'to'             => $paginator->lastItem(),
                'total'          => $paginator->total(),
            ],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function notFound(string $message = 'The requested resource on this server not found.'): \Illuminate\Http\JsonResponse
    {
        return $this->response(Response::HTTP_NOT_FOUND, [
            'message' => $message,
            'code'    => Response::HTTP_NOT_FOUND,
        ]);
    }

    /**
     * Basic response.
     *
     * @param int $code
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    private function response(int $code, $data = []): \Illuminate\Http\JsonResponse
    {
        return response()->json($data, $code);
    }

    /**
     * @inheritDoc
     */
    public function noContent()
    {
        return $this->response(Response::HTTP_NO_CONTENT);
    }
}
