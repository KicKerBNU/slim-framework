<?php

namespace App\Exception;

class TestException extends \Exception{
    public function __contruct($message,$code =0, Exception $previous = null){
        
        parent::__contruct($message,$code,$previous);

    }

    public function __toString(): string{
        return __CLASS__.": [{$this->code}]: {$this->message}\n";
    }
}