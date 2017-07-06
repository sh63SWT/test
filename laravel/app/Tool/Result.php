<?php
namespace App\Tool;
class Result
{
    public $status;
    public $message;

    public function toJson()
    {
        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }
}