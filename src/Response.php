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
        $result = json_decode($response);

        if (getType($result) == "string") $result = json_decode($result);

        if ($result->status) {
            $this->status = $result->status;
            $this->message = $result->message;
        } else {
            $this->status = '200';
            $this->message = $response;
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "{\"status\":\"".$this->status."\", \"message\":\"".$this->message."\"}";
    }
}