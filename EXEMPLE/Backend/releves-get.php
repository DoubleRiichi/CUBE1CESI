<?php 

require("./request-api.php");

error_reporting(E_ALL);
ini_set('display_errors', 'On');

$test = API_get("releves", ['option' => 'all']);

echo $test;

