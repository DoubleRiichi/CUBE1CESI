<?php

use MeteoCube\Config;

require_once('config.php');
require_once('database.php');


include 'header.php';
?>
<div class="container">
    <section>
        <div class="container m-6">
            <?php
            // Vérifiez si le paramètre 'success' est présent dans l'URL
            if (isset($_GET['success']) && $_GET['success'] == 1) {
                var_dump($_GET['success']);
                // Vérifiez si le paramètre 'message' est également présent
                if (isset($_GET['message'])) {
                    $welcome_message = htmlspecialchars($_GET['message']);
                    echo "<h1 class='text-center my-3 fw-bold'>$welcome_message sur votre espace</h1>";
                    echo "Paramètre 'success': " . $_GET['success'];
echo "Paramètre 'message': " . $_GET['message'];

                }
            }
            ?>

            <div class="card container my-4" id="map" style="width: 40rem;">
                <div class="card-body">
                    <h5 class="card-title">Localisation</h5>
            </div>
        </div>
    </section>
</div>


<?php
include 'footer.php';
?>
