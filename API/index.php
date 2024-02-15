<?php declare(strict_types = 1);
 error_reporting(E_ALL); ini_set('display_errors', '1'); //Should be removed
 
    $REQUEST = filter_input(INPUT_SERVER, "REQUEST_URI");
    $params_start = strpos($REQUEST, "?");
    $REQUEST_START = substr($REQUEST, 0, $params_start);

    switch ($REQUEST_START) {
        case '/measures/get':
            include __DIR__ . "/measures/get.php";
            break;
        case '/measures/post':
            include __DIR__ . "/measures/post.php";
            break;
        case '/sensor/get':
            include __DIR__ . "/sensor/get.php";
            break;
        case '/sensor/update':
            include __DIR__ . "/sensor/update.php";
            break;
        default:
            echo "404";
            break;
    }
