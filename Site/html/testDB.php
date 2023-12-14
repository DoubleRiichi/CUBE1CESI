<?php
// Report all PHP errors
error_reporting(E_ALL);

try {
        $dbh = new PDO('mysql:host=localhost;dbname=meteocube', "mael@localhost", "mael");
        echo "ça marche!";
    } catch (PDOException $e) {
        // attempt to retry the connection after some timeout for example
        echo "Erreur";
    }
?>
