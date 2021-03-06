<?php

namespace Client;
use Client\Response;

class RestClient
{
    private string $baseURL;

    public function __construct(string $baseURL) {
        $this->baseURL = $baseURL;
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
                return new Response("{\"status\"': \"407\",\"message\": \"Bad URL\"}");
        } finally {
            curl_close($request);
        }

        $result = new Response($response);
        return $result->getStatus() == '200';
    }

    public function createUser(string $email, string $password) {
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
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payload
        );
        curl_setopt_array($request, $defaults);

        try {
            $response = curl_exec($request);
            if (gettype($response) == "boolean")
                return new Response("{\"status\"': \"407\",\"message\": \"Bad URL\"}");
        } finally {
            curl_close($request);
        }
        $res = json_encode($response);

        return new Response($res);
    }

    public function getToDos(string $email, string $password) {
        $payload = json_encode([
            'email' => $email,
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
                return new Response("{\"status\"': \"407\",\"message\": \"Bad URL\"}");
        } finally {
            curl_close($request);
        }

        return new Response($response);
    }

    public function createToDo(string $email, string $password, string $title, string $description) {
        $payload = json_encode([
            'email' => $email,
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
                return new Response("{\"status\"': \"407\",\"message\": \"Bad URL\"}");
        } finally {
            curl_close($request);
        }

        return new Response($response);
    }

    public function updateToDo(int $id, string $email, string $password, string $title, string $description) {
        $payload = json_encode([
            'email' => $email,
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
                return new Response("{\"status\"': \"407\",\"message\": \"Bad URL\"}");
        } finally {
            curl_close($request);
        }

        return new Response($response);
    }

    public function deleteToDo(int $id, string $email, string $password) {
        $payload = json_encode([
            'email' => $email,
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
                return new Response("{\"status\"': \"407\",\"message\": \"Bad URL\"}");
        } finally {
            curl_close($request);
        }

        return new Response($response);
    }


    public function getFiles() {
        $request = curl_init();
        $defaults = array(
            CURLOPT_RETURNTRANSFER => true,  //return string in case of success
            CURLOPT_URL => $this->baseURL.'/files/',
            CURLOPT_CUSTOMREQUEST => 'GET'
        );
        curl_setopt_array($request, $defaults);

        try {
            $response = curl_exec($request);
            if (gettype($response) == "boolean")
                return new Response("{\"status\"': \"407\",\"message\": \"Bad URL\"}");
        } finally {
            curl_close($request);
        }

        return new Response($response);
    }

    public function addFile(string $name, string $file) {
        if(!file_exists(realpath($file))) {
            return new Response("{\"status\"': \"409\",\"message\": \"No such file\"}");
        }
        $payload = [
            'file' => new \CURLFile($file)];

        $request = curl_init();
        $defaults = array(
            CURLOPT_RETURNTRANSFER => true,  //return string in case of success
            CURLOPT_URL => $this->baseURL.'/files/'.$name,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payload
        );
        curl_setopt_array($request, $defaults);

        try {
            $response = curl_exec($request);
            if (gettype($response) == "boolean")
                return new Response("{\"status\"': \"407\",\"message\": \"Bad URL\"}");
        } finally {
            curl_close($request);
        }

        return new Response($response);
    }

    public function getFileById(int $id) {
        $request = curl_init();
        $defaults = array(
            CURLOPT_RETURNTRANSFER => true,  //return string in case of success
            CURLOPT_URL => $this->baseURL.'/files/'.$id,
            CURLOPT_CUSTOMREQUEST => 'GET'
        );
        curl_setopt_array($request, $defaults);

        try {
            $response = curl_exec($request);
            if (gettype($response) == "boolean")
                return new Response("{\"status\"': \"407\",\"message\": \"Bad URL\"}");
        } finally {
            curl_close($request);
        }

        return new Response($response);
    }

    public function deleteFile(int $id) {
        $request = curl_init();
        $defaults = array(
            CURLOPT_RETURNTRANSFER => true,  //return string in case of success
            CURLOPT_URL => $this->baseURL.'/files/'.$id,
            CURLOPT_CUSTOMREQUEST => 'DELETE'
        );
        curl_setopt_array($request, $defaults);

        try {
            $response = curl_exec($request);
            if (gettype($response) == "boolean")
                return new Response("{\"status\"': \"407\",\"message\": \"Bad URL\"}");
        } finally {
            curl_close($request);
        }

        return new Response($response);
    }
}