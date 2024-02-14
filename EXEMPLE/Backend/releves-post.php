<?php 

require("./request-api.php");


if(isset($_POST["temperature"]) && isset($_POST["humidite"]) && isset($_POST["pression"]) && isset($_POST["date"])) {

    $data = ['temperature' => $_POST['temperature'],
            'humidite'     => $_POST['humidite'],
            'pression'     => $_POST['pression'],
            'date'         => $_POST['date']];

    $result = API_post("releves", $data);

    echo $result;
}
