<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
$db = new PDO("mysql:host=localhost;port=3306;dbname=meteocube;charset=utf8",  "meteocube", "rock");

$req = $db->prepare('select * from `relevés`');
$req->execute();

$result = $req->fetchAll();
print_r($result);

echo "test";
echo var_dump($db);
?>
