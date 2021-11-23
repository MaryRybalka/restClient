<?php

namespace Client;

class Response {
    private $status;
    private $message;

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    public function __construct($response) {
        $result = json_encode($response);
        if ($result['status']) {
            $this->status = $result['status'];
            $this->message = $result['message'];
        } else {
            $this->status = '200';
            $this->message = $result;
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "{\n\"status\":\"".$this->status."\",\n\"status\":\"".$this->message."\"\n}";
    }
}