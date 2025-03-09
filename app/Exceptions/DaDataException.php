<?php

namespace App\Exceptions;

use Illuminate\Support\Facades\Log;

class DaDataException extends \Exception
{
    public function report()
    {
       /* Log::debug("Error DaDataService: [" .
            date('Y-m-d H:i:s') . "] Error: {$this->getMessage()} in the file {$this->getfile()}  on line 40 {$this->getLine()}");*/
        Log::debug("Error DaDataService: {$this->getMessage()} in the file {$this->getfile()}  on line 40 {$this->getLine()}");
    }
}
