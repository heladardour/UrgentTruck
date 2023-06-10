<?php
// Vérification que le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupération des données du formulaire
  $gouvernorat = $_POST['gouvernorat'];
  $hopital = $_POST['hopital'];
  $disponibiliteBoxes = $_POST['disponibiliteBoxes'];
  $disponibiliteScanners = $_POST['disponibiliteScanners'];

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

  // Vérification si une entrée avec la même clé primaire existe déjà dans la table disponibilite_hopital
  $checkQuery = "SELECT id_hopital FROM disponibilite_hopital WHERE id_hopital = ?";
  $checkStmt = $conn->prepare($checkQuery);
  $checkStmt->bind_param("i", $hopital);
  $checkStmt->execute();
  $checkResult = $checkStmt->get_result();

  if ($checkResult->num_rows > 0) {
    // Entrée existante, vous pouvez choisir de mettre à jour les données ou afficher un message d'erreur
    echo "Une entrée avec la même clé primaire existe déjà dans la table disponibilite_hopital.";
  } else {
    // Préparation de la requête SQL pour insérer les données dans la table correspondante
    $insertQuery = "INSERT INTO disponibilite_hopital (id_hopital, heure_mise_a_jour, disponibilite_boxes, disponibilite_scanners) VALUES (?, NOW(), ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("iii", $hopital, $disponibiliteBoxes, $disponibiliteScanners);

    // Exécution de la requête
    if ($insertStmt->execute()) {
      // Données enregistrées avec succès
      echo "Les données ont été enregistrées avec succès dans la base de données.";
      header("Location: confirmation.html");
      exit();
    } else {
      // Erreur lors de l'enregistrement des données
      echo "Une erreur est survenue lors de l'enregistrement des données dans la base de données.";
    }

    // Fermeture de la requête d'insertion
    $insertStmt->close();
  }

  // Fermeture de la requête de vérification
  $checkStmt->close();

  // Fermeture de la connexion à la base de données
  $conn->close();
} else {
  // Redirection vers la page du formulaire si le formulaire n'a pas été soumis
  header("Location: formulaire.html");
  exit();
}
?>
