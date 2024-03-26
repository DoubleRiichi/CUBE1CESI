<?php

include 'header.php';

// Test de connexion à l'API

//MESURES
$url1 = 'http://rock-4c-plus:5000/measures/get/all';
$mesures_all  = json_decode(file_get_contents($url1), true);

$url2 = "http://rock-4c-plus:5000/measures/get/last";
$mesures_last  = json_decode(file_get_contents($url2), true);


//SONDE
$url3= 'http://rock-4c-plus:5000/sensor/get/all';
$url4 ='http://rock-4c-plus:5000/sensor/get/1';
$sensor_all  = json_decode(file_get_contents($url3), true);
$sensor_get  = json_decode(file_get_contents($url4), true);
echo "<br>";

//$curent_date = date('Y-m-d H:i:s');
$curent_date = (new DateTime())->format('d-m-Y');
?>

<div class="container-fluid my-5 bg-light bg-opacity-75 p-4 rounded-3 text-dark">
    <h1 class="fw-bolder text-center">Météo du jour</h1>
    <h3 class='mt-3 fw-bolder text-center'><?php echo $curent_date; ?></h3>
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6 my-5 text-center">
            <img src="../img/humidity.png" alt="humidity icon" title="humidity icon" class="img-fluid">
            <h3 class='mt-3 fw-bolder'><?php echo $mesures_last[0]['humidity']; ?>%</h3>
        </div>
        <div class="col-md-6 text-center">
            <img src="../img/temperature.png" alt="temperature icon" title="temperature icon" class="img-fluid">
            <h3 class='mt-3 fw-bolder'><?php echo $mesures_last[0]['temperature']; ?>°C</h3>
        </div>
        <div class="col-md-6 text-center">
            <img src="../img/placeholder.png" alt="temperature icon" title="temperature icon" class="img-fluid">
            <h3 class='mt-3 fw-bolder'><?php echo $sensor_all[0]['location']; ?></h3><br>
        </div>
    </div>
    <!-- Graphique avec Chart.js -->
    <div>
        <h1 class="fw-bolder text-center mb-4">Graphique de Mesures</h1>
        <input type="radio" id="last-all" name="selection" value="last-all" checked>
        <label for="last-all">Dernières mesures des derniers jours</label>
        <input type="radio" id="last-one" name="selection" value="last-one">
        <label for="last-one">Dernière mesure relevée</label>
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>

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
            <!-- Les mesures seront ajoutées ici dynamiquement -->
        </tbody>
    </table>

    <!--Ajouter une sonde !-->
    <div class="container-fluid my-5">
        <h1 class="fw-bolder text-center">Les sondes</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Date de la dernière mesure</th>
                        <th scope="col">Temps d'allumage</th>
                        <th scope="col">Lieu</th>
                        <th scope="col">Sonde n°</th>
                        <th scope="col">Ajouter</th>
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

<?php
include 'footer.php';
?>

<script>
    
//Fonction sayHello dans la console pour verifier que le fichier marche
function sayHello() {
    console.log("Bienvenue sur notre projet !");
}


//Fonction pour afficher la carte dans la page mon_compte.php
function initMap() {
    // Sélectionner l'élément avec l'ID "map"
    let mapElement = document.getElementById('map');

    // Vérifier si l'élément a été trouvé
    if (mapElement) {
        // Initialiser la carte avec latitude = 45.20718002319336 et longitude= 5.788233757019043 du lieu Ici Meylan
        // et 13 = niveau zoom de la carte
        let mymap = L.map(mapElement).setView([45.20718002319336, 5.788233757019043], 13);

        // Ajouter une couche de tuiles (carte de base)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(mymap);

        // Ajouter un marqueur à une position spécifique
        var marker = L.marker([45.20718002319336, 5.788233757019043]).addTo(mymap);

        // Ajouter une popup au marqueur
        marker.bindPopup("<b>On est ici !</b><br>").openPopup();
    } else {
        console.error("L'élément avec l'ID 'map' n'a pas été trouvé.");
    }
}

//Page meteo pour afficher le resultat en tableau
$(document).ready(function() {
    // Récupérer les données depuis l'API
    const url = 'http://rock-4c-plus:5000/measures/get/all';
    $.getJSON(url, function(data) {
        // Ajouter les données au tableau
        $('#mesures-table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json' 
            },
            data: data,
            columns: [
                { data: 'id_measures' },
                { data: 'temperature' },
                { data: 'humidity' },
                { data: 'date' }
            ],
            order: [[3, 'desc']], // Trier par date décroissante
            pageLength: 10 // Limiter à 10 résultats par page
            
        });

       
    });
});


//Page pour afficher le graphique
$(document).ready(function() {
    const url = 'http://rock-4c-plus:5000/measures/get/last';
    let endpoint = 'all'; // Par défaut, obtenir toutes les mesures

    // Écouter les changements dans les boutons radio
    $('input[type=radio][name=selection]').change(function() {
        if (this.value === 'last-all') {
            endpoint = 'all';
        } else if (this.value === 'last-one') {
            endpoint = 'last';
        }

        // Mettre à jour le graphique
        updateChart(endpoint);
    });

    // Fonction pour obtenir les données et mettre à jour le graphique
    function updateChart(endpoint) {
        const apiUrl = `http://rock-4c-plus:5000/measures/get/${endpoint}`;
        $.getJSON(apiUrl, function(data) {
            const dates = data.map(entry => entry.date);
            const temperatures = data.map(entry => entry.temperature);

            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Température (°C)',
                        data: temperatures,
                        borderColor: 'rgb(255, 99, 132)', // Rouge
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    }

    // Charger le graphique avec les dernières mesures par défaut
    updateChart(endpoint);
});

// Appeler la fonction une fois que le DOM est complètement chargé
document.addEventListener('DOMContentLoaded', initMap);

sayHello();









</script>