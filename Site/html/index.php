<?php 
use MeteoCube\Config;
require_once('config.php');
require_once('database.php');


include 'header.php';

// Vérifiez si des données ont été soumises via le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire
    $login = isset($_POST['login']) ? $_POST['login'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $mot_de_passe = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';

    // Traitez les données comme nécessaire (par exemple, insérez-les dans la base de données)
    $req = $bdd->prepare('INSERT INTO utilisateur (login, email, mot_de_passe, Role) VALUES (?, ?, ?, ?)');
    $req->execute(array($login, $email, $mot_de_passe, 'user'));

    // Effectuez une redirection ou affichez un message de bienvenue ici
    if (isset($login)) {
        echo "<h1 class='text-center my-3 fw-bold'>Bienvenue sur MeteoCube, $login</h1>
        <h2 class='text-center'>Station météorologique conçue par <i>Lepetit</i></h2>";
    } else {
        echo "<h1 class='text-center my-3 fw-bold'>Bienvenue sur MeteoCube</h1>
        <div class='text-center'>
            <p>Pour profiter de nos avantages connectez-vous.</p>
            <a class='btn btn-primary' href='connexion.php'>Connexion</a>
        </div>";
    }
    
    // Par exemple, redirigez l'utilisateur vers une page d'accueil après l'inscription
    echo "Redirection vers index.php";
    header("Location: index.php");
    exit();
}

include 'main.php';
include 'footer.php';
?>
