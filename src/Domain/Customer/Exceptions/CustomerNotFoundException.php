<?php

namespace App\DomainDrivenDesign\Domain\Customer\Exceptions;

use Exception;
use Throwable;

class CustomerNotFoundException extends Exception
{
    public function __construct(int $id, $code = 0, Throwable $previous = null)
    {
        $message = "Id {$id} not found";
        parent::__construct($message, $code, $previous);
    }
}