<?php
session_start();

// Vérifier si l'utilisateur n'est pas connecté
// if (!isset($_SESSION['user_id'])) {
//     // Rediriger vers la page de connexion
//     header("Location: connexion.php");
//     exit();
// }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeteoCube 🌤️</title>
    <!-- Inclusion de jQuery pour les fonctionnalités JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Inclusion de Bootstrap et de bootswatch (template gratuit pour personnaliser bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.2/dist/cosmo/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <!-- Inclusion de Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Inclusion de Leaflet pour les cartes -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Inclusion de DataTables pour les tableaux -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- Lien pour notre fichier CSS -->
    <link rel="stylesheet" href="./../css/style.css">
    <!-- Script nécessaire pour le fonctionnement de la carte, bootstrap et jquery  -->
    <script src="./../js/jquery-3.6.0.min.js"></script>
    <script src="./../js/popper.min.js"></script>
    <!-- Script necessaire pour bootstrap -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Script nécessaire pour le fonctionnement de la carte -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Script nécessaire pour le fonctionnement de DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <!-- Script nécessaire pour le fonctionnement de Chart.js (librairies pour les graphiques) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Lien pour notre fichier JS -->
    <script src="./../script/script.js"></script>
</head>

<body>
   <header>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="./../img/meteocube_logo.png" alt="logo site"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="meteo.php">Météo du jour</a>
                    </li>
                    <?php
                    // Vérifie si le paramètre 'success' est présent dans l'URL
                    if (isset($_GET['success']) && $_GET['success'] == 1) {
                        // Affiche le bouton "Mon Compte" et "Déconnexion" si connecté
                        echo '<li class="nav-item">
                                <a class="nav-link" href="mon_compte.php">Mon Compte</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link btn btn-danger" href="index.php">Déconnexion</a>
                            </li>';
                    } else {
                        // Affiche les liens Connexion et Inscription si non connecté
                        echo '<li class="nav-item">
                                <a class="nav-link" href="connexion.php">Connexion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="inscription.php">Inscription</a>
                            </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

