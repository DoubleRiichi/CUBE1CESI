<?php 

require("./request-api.php");



$test = API_get("releves", ['option' => 'all']);

echo $test;

