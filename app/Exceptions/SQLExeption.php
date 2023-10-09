<?php

namespace App\Exceptions;

use Exception;

class SQLExeption extends Exception
{
    private function __construct($message = "")
    {
        parent::__construct();

        Log::error(
            'SQLExeption: ' . $message, [
            'file' => $this->getFile(),
            'line' => $this->getLine(),
            'trace' => $this->getTrace(),
        ]);
    }
}

?>