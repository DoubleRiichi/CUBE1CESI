<?php

<?php

include 'header.php';

use MeteoCube\Config;

require_once('config.php');
require_once('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $req = $bdd->prepare('SELECT * FROM utilisateur WHERE login = ?');
        $req->execute(array($login));
        $user = $req->fetch();

        if ($user && password_verify($password . $user['salt'], $user['mot_de_passe'])) {
            // Authentification réussie, démarrez la session et redirigez vers mon_compte.php
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header("Location: mon_compte.php?success=1");
            exit();
        } else {
            // Authentification échouée, redirigez vers une page d'erreur
            header("Location: connexion.php?error=authFailed");
            exit();
        }
    }
}


?>
