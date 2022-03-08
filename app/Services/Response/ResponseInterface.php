<?php

namespace App\Services\Response;

use Illuminate\Pagination\LengthAwarePaginator;

interface ResponseInterface
{
    /**
     * The 200 OK HTTP response
     * may include data.
     *
     * @param mixed $data
     * @return mixed
     */
    public function ok(mixed $data);

    /**
     * Determines pagination data.
     *
     * @param \Illuminate\Pagination\LengthAwarePaginator $paginator
     * @return mixed
     */
    public function paginate(LengthAwarePaginator $paginator);

    /**
     * Sends 404 not found response.
     *
     * @param string $message
     * @return mixed
     */
    public function notFound(string $message = ''): mixed;

    /**
     * Delete response
     *
     * @return mixed
     */
    public function noContent();
}
