<?php

include 'header.php';

// Test de connexion à l'API
//pour lancer l'API il faut faire run.py dans le terminal
//MESURES
$test = 'http://127.0.0.1:5000/measures/get/all';
$result_array  = json_decode(file_get_contents($test), true);
//echo $result_array;
$last = "http://127.0.0.1:5000/measures/get/last";
$result_array_last  = json_decode(file_get_contents($last), true);


//SONDE
$sensor= 'http://localhost:5000/sensor/get/all';
$result_array_all_sensor  = json_decode(file_get_contents($sensor), true);
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
            <?php echo "<h3 class='mt-3 fw-bolder'>" . $result_array_last[0]['humidity'] . "%</h3>"; ?>
        </div>
        <div class="col-md-6 text-center">
            <img src="../img/temperature.png" alt="temperature icon" title="temperature icon" class="img-fluid">
            <?php echo "<h3 class='mt-3 fw-bolder'>" . $result_array_last[0]['temperature'] . "°C</h3>"; ?>
        </div>
        <div class="col-md-6 text-center">
            <img src="../img/placeholder.png" alt="temperature icon" title="temperature icon" class="img-fluid">
            <?php echo "<h3 class='mt-3 fw-bolder'>" . $result_array_all_sensor[0]['location'] . "</h3>"; ?>
        </div>
    </div>

    <!-- <div class="row justify-content-center align-items-center bg-light bg-opacity-75 p-4 rounded-3 text-dark">
    <div class="container my-5">
    <h1 class="fw-bolder text-center">Historique des mesures</h1>
    <canvas id="historiqueMesuresChart" width="400" height="200"></canvas>
</div>

<div class="container my-5">
    <h1 class="fw-bolder text-center">Les dernières mesures relevées</h1>
    <canvas id="dernieresMesuresChart" width="400" height="200"></canvas>
</div>

<div class="container my-5">
    <h1 class="fw-bolder text-center">Sonde</h1>
    <canvas id="sondeChart" width="400" height="200"></canvas>
</div>



    <?php
    if ($result_array !== null) {
        // Historique des mesures
        echo "historiqueMesuresChart.data.labels = " . json_encode(array_column($result_array, 'date')) . ";\n";
        echo "historiqueMesuresChart.data.datasets[0].data = " . json_encode(array_column($result_array, 'temperature')) . ";\n";
        echo "historiqueMesuresChart.data.datasets[1].data = " . json_encode(array_column($result_array, 'humidity')) . ";\n";
        echo "historiqueMesuresChart.data.datasets[2].data = " . json_encode(array_column($result_array, 'pressure')) . ";\n";
    }
    if ($result_array_last !== null) {
        // Dernières mesures relevées
        echo "dernieresMesuresChart.data.labels = " . json_encode(array_keys($result_array_last[0])) . ";\n";
        echo "dernieresMesuresChart.data.datasets[0].data = " . json_encode(array_values($result_array_last[0])) . ";\n";
    }
    if ($result_array_all_sensor !== null) {
        // Sonde
        echo "sondeChart.data.labels = " . json_encode(array_column($result_array_all_sensor, 'location')) . ";\n";
        echo "sondeChart.data.datasets[0].data = " . json_encode(array_column($result_array_all_sensor, 'measures_count')) . ";\n";
    }
    
    ?>
    historiqueMesuresChart.update();
    dernieresMesuresChart.update();
    sondeChart.update();


</div> -->



<?php
include 'footer.php'?>
