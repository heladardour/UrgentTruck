<?php
// Récupération de la valeur du gouvernorat sélectionné
$gouvernorat = $_POST['gouvernorat'];

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "urgentrack";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Requête SQL pour récupérer les hôpitaux correspondants au gouvernorat sélectionné
$sql = "SELECT * FROM hopital WHERE code_gov = '$gouvernorat'";
$result = $conn->query($sql);

// Génération des options d'hôpital
$options = '<option value="">Sélectionner un hôpital</option>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row['id_hopital'] . '">' . $row['nom_hopital'] . '</option>';
    }
}

// Fermeture de la connexion à la base de données
$conn->close();

// Renvoi des options d'hôpital
echo $options;
?>
