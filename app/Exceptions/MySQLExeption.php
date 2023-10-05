<?php

namespace App\Exceptions;

use Exception;

class MySQLExeption extends Exception
{
    private function __construct($message = "")
    {
        parent::__construct();

        Log::error(
            'MySQLExeption: ' . $message, [
            'file' => $this->getFile(),
            'line' => $this->getLine(),
            'trace' => $this->getTrace(),
        ]);
    }
}

?>