<?php

if (! function_exists('responder')) {
    /**
     * Handles responses
     *
     * @return \App\Services\Response\ResponseInterface
     */
    function responder():App\Services\Response\ResponseInterface
    {
        return app(App\Services\Response\ResponseInterface::class);
    }
}
