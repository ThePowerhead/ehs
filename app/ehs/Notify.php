<?php
namespace EHS;

class Notify {

    public $message = "";
    public $type = "";

    public function __construct($message, $type = "notify") {
        $this->message = $message;
        $this->type = $type;
    }
}
