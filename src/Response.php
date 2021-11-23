<?php

namespace Client;

class Response {
    private $code;
    private $message;

    public function __construct($response) {
        $result = json_encode($response);
        if ($result['status']) {
            $this->code = $result['status'];
            $this->message = $result['message'];
        } else {
            $this->code = '200';
            $this->message = $result;
        }
    }
}