<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'urgentrack';

// Connexion à la base de données
$connexion = new mysqli($hostname, $username, $password, $database);

// Vérification de la connexion
if ($connexion->connect_errno) {
    die('La connexion à la base de données a échoué : ' . $connexion->connect_error);
} else {
    echo 'Connexion à la base de données réussie avec succès!';
}

// Requête pour récupérer les données des hôpitaux et leur disponibilité
$sql = "SELECT 
    hopital.id_hopital,
    hopital.nom_hopital,
    hopital.type_hopital,
    hopital.adresse_hopital,
    hopital.tel_hopital,
    hopital.code_gov,
    hopital.longitude,
    hopital.latitude,
    hopital.coordonnees,
    disponibilite_hopital.heure_mise_a_jour,
    disponibilite_hopital.disponibilite_boxes,
    disponibilite_hopital.disponibilite_scanners
    FROM hopital
    LEFT JOIN disponibilite_hopital ON hopital.id_hopital = disponibilite_hopital.id_hopital";

// Exécution de la requête
$result = $connexion->query($sql);

// Vérification des erreurs
if (!$result) {
    die("Erreur lors de l'exécution de la requête : " . $connexion->error);
}

// Création d'un tableau pour stocker les données des hôpitaux
$hospitalsData = [];

// Parcours des résultats et création des objets
while ($row = $result->fetch_assoc()) {
    $hospital = [
        'id' => $row['id_hopital'],
        'name' => $row['nom_hopital'],
        'type' => $row['type_hopital'],
        'address' => $row['adresse_hopital'],
        'tel' => $row['tel_hopital'],
        'govCode' => $row['code_gov'],
        'longitude' => $row['longitude'],
        'latitude' => $row['latitude'],
        'coordinates' => $row['coordonnees'],
        'updateTime' => $row['heure_mise_a_jour'],
        'emergencyAvailability' => $row['disponibilite_boxes'],
        'scannerAvailability' => $row['disponibilite_scanners']
    ];
    $hospitalsData[] = $hospital;
}

// Fermeture de la connexion à la base de données
$connexion->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ma Carte Interactive</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <style>
          body {
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        #map {
            height: 400px;
            margin-bottom: 20px;
        }

        #statistics {
            margin-bottom: 20px;
        }

        .hospital-item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div id="map"></div>

    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Utilisation de la variable contenant les données des hôpitaux
        var hospitalsData = <?php echo json_encode($hospitalsData); ?>;

        // Initialisation de la carte
        var map = L.map('map').setView([40.7225, -74.0025], 50);

        // Ajout de la couche de tuiles OpenStreetMap à la carte
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        }).addTo(map);

        // Parcours des données des hôpitaux et ajout des marqueurs à la carte
        hospitalsData.forEach(function(hospital) {
            var marker = L.marker([hospital.latitude, hospital.longitude]).addTo(map);
            marker.bindPopup('<b>' + hospital.name + '</b><br>' + hospital.address);
        });
    </script>
</body>
</html>



