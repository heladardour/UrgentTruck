<?php
// Connexion à la base de données
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'urgentrack';

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données: " . $conn->connect_error);
}

// Requête SQL pour récupérer les données des hôpitaux
$query = "SELECT * FROM hopital";
$result = $conn->query($query);

// Tableau pour stocker les données des hôpitaux
$hospitals = [];

// Parcours des résultats de la requête
while ($row = $result->fetch_assoc()) {
    $hospitals[] = $row;
}

// Conversion des données en format JSON
$json = json_encode($hospitals);

// Envoi de la réponse JSON
header('Content-Type: application/json');
echo $json;

// Fermeture de la connexion à la base de données
$conn->close();
?>