<?php

include 'header.php';

// Test de connexion à l'API
//pour lancer l'API il faut faire run.py dans le terminal
//MESURES
$url1 = 'http://127.0.0.1:5000/measures/get/all';
$mesures_all  = json_decode(file_get_contents($url1), true);
//echo $result_array;
$url2 = "http://127.0.0.1:5000/measures/get/last";
$mesures_last  = json_decode(file_get_contents($url2), true);


//SONDE
$url3= 'http://localhost:5000/sensor/get/all';
$url4 ='http://localhost:5000/sensor/get/1';
$sensor_all  = json_decode(file_get_contents($url3), true);
$sensor_get  = json_decode(file_get_contents($url4), true);
echo "<br>";
//var_dump($result2);

//$curent_date = date('Y-m-d H:i:s');
$curent_date = (new DateTime())->format('d-m-Y');
?>

<div class="container my-5">
    <div class="row justify-content-center align-items-center bg-light bg-opacity-75 p-4 rounded-3 text-dark">
        <h1 class="fw-bolder text-center">Météo du jour</h1>
        <?php echo "<h3 class='mt-3 fw-bolder text-center'>" . $curent_date . "</h3>"; ?>
        <div class="col-md-6 my-5 text-center">
            <img src="../img/humidity.png" alt="humidity icon" title="humidity icon" class="img-fluid">
            <?php echo "<h3 class='mt-3 fw-bolder'>" . $mesures_last[0]['humidity'] . "%</h3>"; ?>
        </div>
        <div class="col-md-6 text-center">
            <img src="../img/temperature.png" alt="temperature icon" title="temperature icon" class="img-fluid">
            <?php echo "<h3 class='mt-3 fw-bolder'>" . $mesures_last[0]['temperature'] . "°C</h3>"; ?>
        </div>
        <div class="col-md-6 text-center">
            <img src="../img/placeholder.png" alt="temperature icon" title="temperature icon" class="img-fluid">
            <?php echo "<h3 class='mt-3 fw-bolder'>" . $sensor_all[0]['location'] . "</h3>"; ?>
        </div>
    </div>


<div class="container mt-5">
    <h1 class="fw-bolder text-center mb-4">Tableau de Mesures</h1>

    <!-- Tableau des mesures -->
    <table id="mesures-table" class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Temperature (°C)</th>
                <th scope="col">Humidité (%)</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody id="mesures-body">
            
        </tbody>
    </table>
</div>

    <!-- Graphique avec Chart.js -->
    <div class="mt-5">
        <canvas id="mesures-chart"></canvas>
    </div>
</div>

<script>
    // Fonction pour filtrer les mesures par tranche de 6 heures
    function filtrerParTranche() {
        // Implémentez la logique de filtrage ici
        alert("Filtrage par tranche de 6 heures");
    }

    // Récupérez les données pour le graphique
    // Par exemple, vous pouvez utiliser les données de mesures_all pour créer le graphique avec Chart.js
    // Utilisez la documentation de Chart.js pour savoir comment créer un graphique : https://www.chartjs.org/docs/latest/
</script>


    <!--Ajouter une sonde !-->

    <div class="container my-5">
    <h1 class="fw-bolder text-center">Les sondes</h1>
    <div class="row justify-content-center">
        <div class="col-md-12 my-5">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Date de la dernière mesure</th>
                            <th scope="col">Temps d'allumage</th>
                            <th scope="col">Lieu</th>
                            <th scope="col">Sonde n°</th>
                            <th scope="col">Ajouter</th>  <!-- Nouvelle colonne pour les boutons -->
                            <th scope="col">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sensor_all  as $key => $item): ?>
                        <tr>
                            <th scope="row"><?php echo $key + 1 ?></th>
                            <td><?php echo $item['last_boot_date'] ?></td>
                            <td><?php echo $item['last_boot_time'] ?></td>
                            <td><?php echo $item['location'] ?></td>
                            <td><?php echo $item['id_sensor'] ?></td>
                            <!-- Bouton Supprimer en rouge -->
                            <td><button type="button" class="btn btn-warning">Ajouter</button></td>
                            <td><button type="button" class="btn btn-danger">Supprimer</button></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

