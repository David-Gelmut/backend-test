<?php

namespace App\Exceptions;

use Illuminate\Support\Facades\Log;

class CompanyException extends \Exception
{

    public function report()
    {
        Log::debug("Error CompanyService: {$this->getMessage()} in the file {$this->getfile()}  on line 40 {$this->getLine()}");
    }
}
