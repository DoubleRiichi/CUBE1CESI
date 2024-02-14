<?php

const PORT = 8081; // changer le port pour celui utilisé par le virtual host

const API_URL = 'http://192.168.54.223:' . PORT . '/';


function API_post($endpoint, $data) { // $data doit être un tableau, le tableau doit correspondre aux champs de la bdd ['temperature' => '40']

    $full_url = API_URL . $endpoint;

    $option = [ 
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context = stream_context_create($option);
    $result = file_get_contents($full_url, false, $context);
  
    if ($result === false) {
     echo "erreur!";
    }

    return $result;
}



function API_get($endpoint, $data) { // $data doit être un tableau, le tableau doit correspondre aux champs de la bdd ['temperature' => '40']

    $parameters = http_build_query($data);

    $full_url = API_URL . $endpoint . '.php' . '?' . $parameters; //http://URL/FILE.PHP?ARGS

    $result = file_get_contents($full_url);

    if ($result === false) {
     echo "erreur!";
    }

    return $result;
}

?>
