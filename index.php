<?php

require_once 'Autoloader.php';

use Curl\CurlWrapper;
use Curl\Requests\GetRequest;

//Wrapper initialisieren
$o_curl = new CurlWrapper('http://www.google.com/');

//Request ausführen.
$o_response = $o_curl->request(
    new GetRequest([
        //Request-Parameter angeben.
        'q' => 'test'
    ])
);

var_dump($o_response->decode());

//Resource wieder loswerden/schließen.
$o_curl->dispose();
exit;