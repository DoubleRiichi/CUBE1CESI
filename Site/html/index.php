<?php 
use MeteoCube\Config;
require_once('config.php');

include 'header.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['login']) && !empty($_POST['mot_de_passe']) && !empty($_POST['email'])) {
    
        $login      = $_POST['login'];
        $email      = $_POST['email'];
        $password   = $_POST['mot_de_passe'];
    
        echo "login : $login <br> email : $email <br> mot de passe : $password <br>";
    
        // Cryptage du mot de passe
        $password = "aq1" . sha1($password . "1254") . "25";
    
        // Vérifiez si l'email existe déjà dans la base de données
        $req = $bdd->prepare('SELECT count(*) as numberEmail FROM utilisateur WHERE email = ?');
        $req->execute(array($email));
    
        while ($email_row = $req->fetch()) {
            if ($email_row['numberEmail'] != 0) {
                echo "L'email existe déjà";
                header("Location: inscription.php?error=1&email=1L'email existe déjà");
                exit();
            }
        }
    
        //Envoie de la requête sur la BDD
        $req = $bdd->prepare('INSERT INTO utilisateur (login, email, mot_de_passe, Role) VALUES (?, ?, ?, ?)');
        $req->execute(array($login, $email, $password, 'user'));

        // Redirection après l'inscription réussie
        header("Location: index.php");
        exit();
    }
}

include 'main.php';
include 'footer.php';
?>
