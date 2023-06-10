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

// Effectuer une requête SQL pour récupérer les informations des hôpitaux
$sql = "SELECT nom_hopital, type_hopital, adresse_hopital, tel_hopital, latitude, longitude
        FROM hopital";
$result = $conn->query($sql);

// Créer un tableau pour stocker les données des hôpitaux
$hospitalsData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hospitalsData[] = $row;
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