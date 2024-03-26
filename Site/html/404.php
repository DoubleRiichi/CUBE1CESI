<?php 
use MeteoCube\Config;

require_once('config.php');


include 'header.php';
?>
<body>
    <main>
        <div class="container my-5 text-center">
            <h1 class="display-1">Oops! La page n'existe pas</h1>
                <p class="lead">Retournez à <a href="index.php" class="">la page d'accueil</a>.</p>
                <img src="/img/error.png" alt="404 Not Found" class="img-fluid">
            
        </div>

    </main>

            
<?php
include 'footer.php';

?>