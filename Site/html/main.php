<?php

use MeteoCube\Config;
require_once('config.php');
require_once('database.php');

?>

    <section>
        <?php
        // Vérifiez si le paramètre 'success' est présent dans l'URL
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            // Vérifiez si le paramètre 'message' est également présent
            if (isset($_GET['message'])) {
                $welcome_message = htmlspecialchars($_GET['message']);
                echo "<h1 class='text-center my-3 fw-bold'>$welcome_message</h1>";
            }
        } else 
        {
            echo' <div class="container my-5 text-white">
            <div class="row">
            <h1 class="fw-bold">Bienvenue sur MeteoCube</h1>
                <div class="col-md-6 text-center">
                    <img src="/img/baloon.png" alt="station" class="img-fluid">
                </div>    
                <div class="col-md-6">
                    <h2 class="fw-bolder">Qui sommes-nous ?</h2>
                    <p class="fw-bolder">
                        Fondée en 1992, la société "LePetit" s\'est imposée comme un acteur majeur de l\'industrie technologique.<br>
                        Avec un chiffre d\'affaires remarquable de 1,275 milliard d\'euros en 2017, cela a démontré notre excellence dans le domaine.
                        Depuis 2019, nous nous spéacilisons dans les objets connectés pour la maison afin de vous simplifier votre quotidien.<br><br>
                        Aujourd\'hui, nous sommes fière de vous présenter "MeteoCube" une station météorologique connectée de pointe, qui vous permettra de suivre en temps réel les conditions météorologiques de votre région.<br>
                    </p>
                    <div class="text-center">
                        <h3 class="fw-bolder mb-2">Connectez-vous ou inscrivez-vous</h3>
                        <a class="btn btn-primary d-inline-block mx-2" href="connexion.php">Connexion</a>
                        <a class="btn btn-secondary d-inline-block mx-2" href="inscription.php">Inscription</a>
                </div>
            </div>
            </div>';
        }
        ?>
    </section>
