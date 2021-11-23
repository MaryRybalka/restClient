<?php

require_once dirname(__DIR__).'/client/vendor/autoload.php';

use Client\RestClient;

$client = new RestClient('http://127.0.0.1:8000');
echo($client->createUser("masha@mail.com", "123"));
echo($client->getToDos("masha@mail.com", "123"));
echo($client->getToDos("petya@mail.com", "1233"));
echo($client->getToDos("petya@mail.com", "123"));