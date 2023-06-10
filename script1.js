
// Récupérer les données des hôpitaux depuis le serveur
var hospitalsData;

function getHospitalsData() {
    $.ajax({
        url: 'data.php',
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

// Créer une fonction pour générer le contenu HTML du pop-up
function createPopupContent(hospital) {
    var popupContent = '<div class="custom-popup">' +
        '<div class="popup-header">' +
        '<div class="hospital-type">' + hospital.type_hopital + '</div>' +
        '<h4 class="hospital-name">' + hospital.nom_hopital + '</h4>' +
        '</div>' +
        '<div class="availability-section">' +
        '<div class="availability-item ' + (hospital.disponibilite_scanners > 0 ? 'available' : 'unavailable') + '">' +
        '<div class="availability-label">Disponibilité des scanners</div>' +
        '<div class="availability-value">' + hospital.disponibilite_scanners + '</div>' +
        '</div>' +
        '<div class="availability-item ' + (hospital.disponibilite_boxes > 0 ? 'available' : 'unavailable') + '">' +
        '<div class="availability-label">Disponibilité des boxes d\'urgence</div>' +
        '<div class="availability-value">' + hospital.disponibilite_boxes + '</div>' +
        '</div>' +
        '</div>' +
        '<div class="hospital-details">' +
        '<div class="hospital-address">' + hospital.adresse_hopital + '</div>' +
        '<div class="hospital-phone">' + hospital.tel_hopital + '</div>' +
        '</div>' +
        '</div>';

    return popupContent;
}

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
            iconUrl: 'hopital.png',
            iconSize: [35, 35],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });
        var marker = L.marker([hospital.latitude, hospital.longitude], { icon: customIcon }).addTo(map);

        var popupContent = createPopupContent(hospital);
        marker.bindPopup(popupContent, {
            minWidth: 300
        });

        markers.push(marker);
    }
}

// Effectuer des requêtes AJAX périodiques pour mettre à jour les données des hôpitaux toutes les 5 secondes
setInterval(getHospitalsData, 5000);

// Appeler la fonction pour récupérer les données des hôpitaux au chargement de la page
getHospitalsData();