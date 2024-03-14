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
?>

<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6 text-center ">
            <img src="../img/humidity.png" alt="humidity icon" title="humidity icon" class="img-fluid">
            <?php echo "<h3 class='mt-3 fw-bolder'>". $result_array_last[0]['humidity'] . "%"; ?>
        </div>
        <div class="col-md-6 text-center">
            <img src="../img/temperature.png" alt="temperature icon" title="temperature icon" class="img-fluid">
            <?php echo "<h3 class='mt-3 fw-bolder'>" . $result_array_last[0]['temperature'] . "°C</h3>"; ?>
        </div>
        <div class="col-md-6 text-center">
            <img src="../img/placeholder.png" alt="temperature icon" title="temperature icon" class="img-fluid">
            <h2 class="mt-3 fw-bolder">Meylan</h2>
        </div>
    </div>
</div>

<?php

// Affichage des données
if ($result_array !== null) {
    // Vous pouvez supprimer cette partie du code qui affiche les données sous forme de tableau

} else {
    echo "Erreur lors du décodage JSON.";
}

//Affichage des données de la dernière mesure
if ($result_array_last !== null) {
    // Vous pouvez supprimer cette partie du code qui affiche les données sous forme de tableau

} else {
    echo "Erreur lors du décodage JSON.";
}

// Affichage des données de la sonde
if ($result_array_all_sensor !== null) {
    // Vous pouvez supprimer cette partie du code qui affiche les données sous forme de tableau

} else {
    echo "Erreur lors du décodage JSON.";
}

include 'footer.php'?>
