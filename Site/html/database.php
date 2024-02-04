<?php

use MeteoCube\Config;
require_once('config.php');
    

try{
    $bdd = new PDO('mysql:host='.Config::DB_HOST.';dbname='.Config::DB_NAME.';charset=utf8', Config::DB_USER, Config::DB_PASSWORD);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "la base de données est connectée avec succès !";

}catch(PDOException $e){
    echo 'Erreur de connexion à la base de données : '.$e->getMessage();
}

?>