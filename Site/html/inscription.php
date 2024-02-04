<?php 
include 'header.php';
use MeteoCube\Config;

require_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['login']) && !empty($_POST['mot_de_passe']) && !empty($_POST['email'])) {
    
        $login      = $_POST['login'];
        $email      = $_POST['email'];
        $password   = $_POST['mot_de_passe'];
    
    
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
?>

<div class="container">
<section>
    <div class="container my-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-12 col-xl-8">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body my-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-8 col-xl-6 order-2 order-lg-1">

                                <p class="text-primary text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Inscription</p>

                                <form method="post" action="index.php" class="register-form">

                                    <div>
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="mb-3">
                                            <input type="text" name ="login" required class="form-control" />
                                            <label class="form-label">Identifiant</label>
                                        </div>
                                    </div>

                                    <div>
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="mb-3">
                                            <input type="email" name ="email" required class="form-control" />
                                            <label class="form-label">Email</label>
                                        </div>
                                    </div>

                                    <div>
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="mb-3">
                                            <input type="password" name ="mot_de_passe" required class="form-control" />
                                            <label class="form-label" >Mot de passe</label>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary btn-lg mt-3">Inscription</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

<?php
include 'footer.php'
?>