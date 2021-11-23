<?php

namespace Client;
use Client\Response;

class Client
{
    private string $baseURL="";

    public function __construct(string $baseURL) {
        $this->$baseURL = $baseURL;
    }

    public function isRegistered(string $email, string $password){
        $payload = json_encode([
            'email' => $email,
            'password' => $password],
            JSON_UNESCAPED_UNICODE);
        $request = curl_init();
        $defaults = array(
            CURLOPT_RETURNTRANSFER => true,  //return string in case of success
            CURLOPT_URL => $this->baseURL.'/user',
            CURLOPT_HTTPHEADER => array(
                'Content-type: application/json',
                'Content-Length: '.strlen($payload)
            ),
            CURLOPT_CUSTOMREQUEST => 'GET'
        );
        curl_setopt_array($request, $defaults);

        try {
            $response = curl_exec($request);
            if (gettype($response) == "boolean")
                return new Response("{'status': '407','message' => 'Bad URL',}");
        } finally {
            curl_close($request);
        }

        $result = new Response($response);
        return $result->getStatus() == '200';
    }

    public function createUser(string $email, string $password) {
        $payload = json_encode([
            'username' => $email,
            'password' => $password],
            JSON_UNESCAPED_UNICODE);
        $request = curl_init();
        $defaults = array(
            CURLOPT_RETURNTRANSFER => true,  //return string in case of success
            CURLOPT_URL => $this->baseURL.'/user',
            CURLOPT_HTTPHEADER => array(
                'Content-type: application/json',
                'Content-Length: '.strlen($payload)
            ),
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payload
        );
        curl_setopt_array($request, $defaults);

        try {
            $response = curl_exec($request);
            if (gettype($response) == "boolean")
                return new Response("{'status': '407','message' => 'Bad URL',}");
        } finally {
            curl_close($request);
        }

        return new Response($response);
    }

    public function getToDos(string $email, string $password) {
        $payload = json_encode([
            'username' => $email,
            'password' => $password],
            JSON_UNESCAPED_UNICODE);

        $request = curl_init();
        $defaults = array(
            CURLOPT_RETURNTRANSFER => true,  //return string in case of success
            CURLOPT_URL => $this->baseURL.'/todo',
            CURLOPT_HTTPHEADER => array(
                'Content-type: application/json',
                'Content-Length: '.strlen($payload)
            ),
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => $payload
        );
        curl_setopt_array($request, $defaults);

        try {
            $response = curl_exec($request);
            if (gettype($response) == "boolean")
                return new Response("{'status': '407','message' => 'Bad URL',}");
        } finally {
            curl_close($request);
        }

        return new Response($response);
    }

    public function createToDo(string $email, string $password, string $title, string $description) {
        $payload = json_encode([
            'username' => $email,
            'password' => $password,
            'title' => $title,
            'description' => $description],
            JSON_UNESCAPED_UNICODE);

        $request = curl_init();
        $defaults = array(
            CURLOPT_RETURNTRANSFER => true,  //return string in case of success
            CURLOPT_URL => $this->baseURL.'/todo',
            CURLOPT_HTTPHEADER => array(
                'Content-type: application/json',
                'Content-Length: '.strlen($payload)
            ),
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payload
        );
        curl_setopt_array($request, $defaults);

        try {
            $response = curl_exec($request);
            if (gettype($response) == "boolean")
                return new Response("{'status': '407','message' => 'Bad URL',}");
        } finally {
            curl_close($request);
        }

        return new Response($response);
    }

    public function updateToDo(int $id, string $email, string $password, string $title, string $description) {
        $payload = json_encode([
            'username' => $email,
            'password' => $password,
            'title' => $title,
            'description' => $description],
            JSON_UNESCAPED_UNICODE);

        $request = curl_init();
        $defaults = array(
            CURLOPT_RETURNTRANSFER => true,  //return string in case of success
            CURLOPT_URL => $this->baseURL.'/todo/'.$id,
            CURLOPT_HTTPHEADER => array(
                'Content-type: application/json',
                'Content-Length: '.strlen($payload)
            ),
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $payload
        );
        curl_setopt_array($request, $defaults);

        try {
            $response = curl_exec($request);
            if (gettype($response) == "boolean")
                return new Response("{'status': '407','message' => 'Bad URL',}");
        } finally {
            curl_close($request);
        }

        return new Response($response);
    }

    public function deleteToDo(int $id, string $email, string $password) {
        $payload = json_encode([
            'username' => $email,
            'password' => $password],
            JSON_UNESCAPED_UNICODE);

        $request = curl_init();
        $defaults = array(
            CURLOPT_RETURNTRANSFER => true,  //return string in case of success
            CURLOPT_URL => $this->baseURL.'/todo/'.$id,
            CURLOPT_HTTPHEADER => array(
                'Content-type: application/json',
                'Content-Length: '.strlen($payload)
            ),
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_POSTFIELDS => $payload
        );
        curl_setopt_array($request, $defaults);

        try {
            $response = curl_exec($request);
            if (gettype($response) == "boolean")
                return new Response("{'status': '407','message' => 'Bad URL',}");
        } finally {
            curl_close($request);
        }

        return new Response($response);
    }
}