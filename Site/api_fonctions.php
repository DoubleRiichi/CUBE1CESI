API : "measures/get"
-> Récupérer tous les relevés de toutes les sondes : ["option" => "all"]
-> Récupérer tous les relevés d'une sonde en particulier : ["option" => "all", "sensor" => ID_DE_LA_SONDE]

-> Récupérer le dernier relevés de toutes les sondes : ["option" => "last"]
-> Récupérer le dernier relevés d'une sonde en particulier : ["option" => "last", "sensor" => ID_DE_LA_SONDE]

-> Récupérer les relevés d'un journée précise : ["option" => "on_date", "date" => DATE] (DATE doit être au format "YYYY-MM-DD")

-> Récupérer les relevés entre deux dates : ["option" => "on_date", "first_date" => DATE1, "second_date" => DATE2] (DATE doit être au format "YYYY-MM-DD")
-> Récupérer les relevés après une certaine heure à une certaine date : ["option" => "since_x_hours", "date" => DATE, "time" => TIME] (DATE doit être au format "YYYY-MM-DD", TIME doit être au format "HH:MM:SS")



<?php

const PORT = 8081; // changer le port pour celui utilisé par le virtual host
const API_URL = 'http://192.168.121.223:' . PORT . '/';

//Cette fonction est suffisante pour faire des GET vers l'API
function API_call($endpoint, $data) { // $data doit être un tableau avec les arguments que l'on veut utiliser dans le lien de l'API
    $parameters = http_build_query($data);

    $full_url = API_URL . $endpoint . '?' . $parameters;
    $result = file_get_contents($full_url);

    return $result;
}

//exemple d'utilisation
$res = API_call("measures/get", ['option' => "all", 'sensor' => "2"]);
echo $res;
