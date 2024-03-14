
//Fonction sayHello dans la console pour verifier que le fichier marche
function sayHello() {
    console.log("Bienvenue sur notre projet !");
}
sayHello();

//ChartJS
// Code JavaScript pour générer les graphiques
    // Historique des mesures
    var historiqueMesuresCanvas = document.getElementById('historiqueMesuresChart').getContext('2d');
    var historiqueMesuresChart = new Chart(historiqueMesuresCanvas, {
        type: 'line',
        data: {
            labels: [], // Remplacez les labels par les dates des mesures
            datasets: [{
                label: 'Temperature (°C)',
                data: [], // Remplacez les données par les températures
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1,
                fill: false
            }, {
                label: 'Humidité (%)',
                data: [], // Remplacez les données par les humidités
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 1,
                fill: false
            }, {
                label: 'Pression',
                data: [], // Remplacez les données par les pressions
                borderColor: 'rgb(75, 192, 192)',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Dernières mesures relevées
    var dernieresMesuresCanvas = document.getElementById('dernieresMesuresChart').getContext('2d');
    var dernieresMesuresChart = new Chart(dernieresMesuresCanvas, {
        type: 'line',
        data: {
            labels: [], // Remplacez les labels par les noms des mesures
            datasets: [{
                label: 'Valeur',
                data: [], // Remplacez les données par les valeurs des mesures
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    // Sonde
    var sondeCanvas = document.getElementById('sondeChart').getContext('2d');
    var sondeChart = new Chart(sondeCanvas, {
        type: 'line',
        data: {
            labels: [], // Remplacez les labels par les lieux des sondes
            datasets: [{
                label: 'Dernières mesures',
                data: [], // Remplacez les données par les dernières mesures des sondes
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });



    // Créer le graphique avec Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Temperature',
                data: temperatures,
                borderColor: 'red',
                backgroundColor: 'rgba(255, 0, 0, 0.1)',
            }, {
                label: 'Humidity',
                data: humidities,
                borderColor: 'blue',
                backgroundColor: 'rgba(0, 0, 255, 0.1)',
            }, {
                label: 'Pressure',
                data: pressures,
                borderColor: 'green',
                backgroundColor: 'rgba(0, 255, 0, 0.1)',
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



// Appeler la fonction une fois que le DOM est complètement chargé
document.addEventListener('DOMContentLoaded', initMap);








