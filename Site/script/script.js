
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








