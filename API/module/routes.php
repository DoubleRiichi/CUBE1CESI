<?php 


$url = $_SERVER['REQUEST_URI'];


if($_SERVER["REQUEST_METHOD"] == "GET") {

    switch ($url) {
        case '/measures/':
            include('./measure.php');
            break;
        
        default:
            echo "404 NOT FOUND";
            break;
    } 
}
