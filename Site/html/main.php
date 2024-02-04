<?php

require_once('database.php');
require_once('config.php');
use MeteoCube\Config;


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

}
?>
<body>
    <main>
        <div class="container m-6">
            <?php
            if (isset($login)) {
                echo "<h1 class='text-center my-3 fw-bold'>Bienvenue sur MeteoCube, $login</h1>
                <h2 class='text-center'>Station météorologique conçue par <i>Lepetit</i></h2>";
            } else {
                echo "<h1 class='text-center my-3 fw-bold'>Bienvenue sur MeteoCube</h1>
                <div class='text-center'>
                    <p>Pour profiter de nos avantages connectez-vous.</p>
                    <button class='btn btn-primary'><a class='nav-link' href='connexion.php'>Se connecter</a></button>
                </div>";
            }
            if (isset($_GET['error'])) {
                if(isset($_GET['email'])){
                    echo "<p class='text-danger text-center'>Cet email existe déja.<br> Merci d'utiliser une autre adresse mail</p>";
                    }
            }
            ?>            
            <div class="card container my-4" id="map"style="width: 40rem;">
            </div>
            
        </div>

    </main>

