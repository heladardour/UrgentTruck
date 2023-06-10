<?php
// Établir une connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "urgentrack";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Effectuer une requête SQL pour récupérer les informations des hôpitaux et leur disponibilité
$sql = "SELECT hopital.id_hopital, hopital.nom_hopital, hopital.type_hopital, hopital.adresse_hopital, hopital.tel_hopital, hopital.latitude, hopital.longitude, disponibilite_hopital.heure_mise_a_jour, disponibilite_hopital.disponibilite_boxes, disponibilite_hopital.disponibilite_scanners
        FROM hopital
        INNER JOIN disponibilite_hopital ON hopital.id_hopital = disponibilite_hopital.id_hopital";
$result = $conn->query($sql);

// Créer un tableau pour stocker les données des hôpitaux
$hospitalsData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hospitalData = [
            'id_hopital' => $row['id_hopital'],
            'nom_hopital' => $row['nom_hopital'],
            'type_hopital' => $row['type_hopital'],
            'adresse_hopital' => $row['adresse_hopital'],
            'tel_hopital' => $row['tel_hopital'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
            'heure_mise_a_jour' => $row['heure_mise_a_jour'],
            'disponibilite_boxes' => $row['disponibilite_boxes'],
            'disponibilite_scanners' => $row['disponibilite_scanners']
        ];
        $hospitalsData[] = $hospitalData;
    }
}

// Convertir les données en format JSON pour les transmettre au code JavaScript
$hospitalsDataJson = json_encode($hospitalsData);

// Fermer la connexion à la base de données
$conn->close();

// Renvoyer les données au format JSON
header('Content-Type: application/json');
echo $hospitalsDataJson;
?>


