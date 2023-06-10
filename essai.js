// Récupérer les données des hôpitaux depuis le serveur
var hospitalsData;
function getHospitalsData() {
    $.ajax({
        url: 'data_hos.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            hospitalsData = data;
            updateMapMarkers();
        },
        error: function(xhr, status, error) {
            console.error('Erreur lors de la récupération des données des hôpitaux:', error);
        }
    });
}

// Initialiser la carte et les marqueurs
var map = L.map('map').setView([36.8065, 10.1815], 10);
L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://carto.com/">CARTO</a>, contributors, ',
    maxZoom: 18
}).addTo(map);
var markers = [];

// Mettre à jour les marqueurs de carte avec les données des hôpitaux
function updateMapMarkers() {
    // Supprimer les marqueurs existants de la carte
    for (var i = 0; i < markers.length; i++) {
        map.removeLayer(markers[i]);
    }

    // Ajouter les nouveaux marqueurs sur la carte
    for (var i = 0; i < hospitalsData.length; i++) {
        var hospital = hospitalsData[i];
        var customIcon = L.icon({
            iconUrl: 'hos.png',
            iconSize: [35, 35],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });
        var marker = L.marker([hospital.latitude, hospital.longitude], { icon: customIcon }).addTo(map);

        var popupContent = '<strong>' + hospital.nom_hopital + '</strong><br>' +
                           'Type: ' + hospital.type_hopital + '<br>' +
                           'Adresse: ' + hospital.adresse_hopital + '<br>' +
                           'Téléphone: ' + hospital.tel_hopital + '<br>' +
                           'Disponibilité Boxes: ' + hospital.disponibilite_boxes + '<br>' +
                           'Disponibilité Scanners: ' + hospital.disponibilite_scanners;
        marker.bindPopup(popupContent);

        markers.push(marker);
    }
}

// Effectuer des requêtes AJAX périodiques pour mettre à jour les données des hôpitaux toutes les 5 secondes
setInterval(getHospitalsData, 5000);