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
    ?>