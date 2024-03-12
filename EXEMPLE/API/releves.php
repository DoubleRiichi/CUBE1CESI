<?php

require("./BDD.php");
error_reporting(E_ALL);
ini_set('display_errors', 'On');


if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
    if(isset($_POST['temperature']) && isset($_POST['humidite']) && isset($_POST['date']) && isset($_POST['pression'])) {
        $temp     =  (int) $_POST['temperature'];
        $humidite =  (int) $_POST['humidite'];
        $pression =  (int) $_POST['pression'];
        $date     =  (string) $_POST['date'];

            
        $dbAccess = new Database;
        $res = $dbAccess->insert_measure($temp, $humidite,  $pression, $date); //Et voilà! dans la BDD       

        echo $res
    }
    
}


if($_SERVER['REQUEST_METHOD'] == "GET") {

    if(isset($_GET['option'])) {

        $option = (string) $_GET['option'];
        $dbAccess = new Database;
        
        if($option == "all") {
            $temps = $dbAccess->get_all_measures();

             print_r($temps);
        }
    }
}
