<?php
// Report all PHP errors
function getCredential() {
    $file = fopen("/home/jimmy/.env", "r");
    
    $user = fgets($file);
    $pwd  = fgets($file);

    return array(trim($user), $pwd);
}



try {

        $cred = getCredential();
        $dbh = new PDO('mysql:host=localhost;dbname=test', $cred[0], $cred[1]);
        echo "ça marche!";
    } catch (PDOException $e) {
        // attempt to retry the connection after some timeout for example
        echo $e;
    }
?>
