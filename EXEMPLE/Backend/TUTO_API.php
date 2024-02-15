<?php
 error_reporting(E_ALL); ini_set('display_errors', '1'); //Should be removed

const PORT = 8081; // changer le port pour celui utilisé par le virtual host
const API_URL = 'http://192.168.121.223:' . PORT . '/';

function API_call($endpoint, $data) { // $data doit être un tableau avec les arguments que l'on veut utiliser dans le lien de l'API
    $parameters = http_build_query($data);

    $full_url = API_URL . $endpoint . '?' . $parameters;
    echo $full_url;
    $result = file_get_contents($full_url);

    return $result;
}

$res = API_call("measures/get", ['option' => "all", 'sensor' => "2"]);
$params = http_build_query( ['option' => "all", 'sensor' => "2"]);
echo $full_url = API_URL . "measures/get" . "?" . $parameters;
