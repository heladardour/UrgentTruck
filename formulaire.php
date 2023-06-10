<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulaire</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Formulaire</h1>

    <div id="date"></div> <!-- Affichage de la date -->
    <div id="heure"></div> <!-- Affichage de l'heure -->

    <form method="POST" action="traitement_formulaire.php" accept-charset="UTF-8">
      <div class="form-group">
        <label for="gouvernorat">Gouvernorat :</label>
        <select name="gouvernorat" id="gouvernorat" required>
          <option value="">Sélectionner un gouvernorat</option>
          <!-- Code PHP pour afficher les options de gouvernorat depuis la base de données -->
          <?php
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

          // Requête SQL pour récupérer les gouvernorats depuis la table gouvernorat
          $sql = "SELECT * FROM gouvernorat";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo '<option value="' . $row['code_gov'] . '">' . $row['nom_gov'] . '</option>';
              }
          }

          // Fermeture de la connexion à la base de données
          $conn->close();
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="hopital">Nom de l'hôpital :</label>
        <select name="hopital" id="hopital" required>
          <option value="">Sélectionner un hôpital</option>
          <!-- Les options d'hôpital seront générées dynamiquement en fonction du gouvernorat sélectionné -->
        </select>
      </div>
      <div class="form-group">
        <label for="disponibiliteBoxes">Disponibilité des boxes d'urgence :</label>
        <input type="number" name="disponibiliteBoxes" id="disponibiliteBoxes" required>
      </div>
      <div class="form-group">
        <label for="disponibiliteScanners">Disponibilité des scanners :</label>
        <input type="number" name="disponibiliteScanners" id="disponibiliteScanners" required>
      </div>
      <button type="submit">Envoyer</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
