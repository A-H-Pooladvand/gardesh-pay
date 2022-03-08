<?php

namespace App\Exceptions;

class NotFoundException extends \Exception
{
    public function render(string $message = '')
    {
        return responder()->notFound($message);
    }
}
