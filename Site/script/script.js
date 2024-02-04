
//Fonction sayHello dans la console pour verifier que le fichier marche
function sayHello() {
    console.log("Bienvenue sur notre projet !");
}
sayHello();

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
        marker.bindPopup("<b>Vous êtes ici!</b><br>").openPopup();
    } else {
        console.error("L'élément avec l'ID 'map' n'a pas été trouvé.");
    }
}

// Appeler la fonction une fois que le DOM est complètement chargé
document.addEventListener('DOMContentLoaded', initMap);





