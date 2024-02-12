<?php 
require_once("./module/Database/Measurements.php");


$m = new Measurements;
var_dump($m->get_all_measures());
