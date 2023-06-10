<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }

        .container {
            max-width: 800px;
        }

        .form-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Liste des utilisateurs</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
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

                // Récupération de la liste des utilisateurs depuis la table utilisateur
                $sql = "SELECT * FROM utilisateur";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row['id_utilisateur'] . "</td><td>" . $row['nom_utilisateur'] . "</td><td>" . $row['type_utilisateur'] . "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Aucun utilisateur trouvé.</td></tr>";
                }

                // Fermeture de la connexion à la base de données
                $conn->close();
                ?>
            </tbody>
        </table>

        <h2>Liste des hôpitaux</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Adresse</th>
                    <th>Téléphone</th>
                    <th>Code gouvernorat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connexion à la base de données
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Vérification de la connexion
                if ($conn->connect_error) {
                    die("La connexion à la base de données a échoué : " . $conn->connect_error);
                }

                // Récupération de la liste des hôpitaux depuis la table hopital
                $sql = "SELECT * FROM hopital";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row['id_hopital'] . "</td><td>" . $row['nom_hopital'] . "</td><td>" . $row['type_hopital'] . "</td><td>" . $row['adresse_hopital'] . "</td><td>" . $row['tel_hopital'] . "</td><td>" . $row['code_gov'] . "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Aucun hôpital trouvé.</td></tr>";
                }

                // Fermeture de la connexion à la base de données
                $conn->close();
                ?>
            </tbody>
        </table>

        <div class="form-container">
            <h2>Ajouter un utilisateur</h2>
            <form method="post" action="">
                <div class="form-group">
                    <input type="text" name="nomUtilisateur" class="form-control" placeholder="Nom de l'utilisateur" required>
                </div>
                <!-- Autres champs d'utilisateur à ajouter -->
                <button type="submit" name="ajouterUtilisateur" class="btn btn-primary">Ajouter</button>
            </form>
        </div>

        <div class="form-container">
            <h2>Modifier un utilisateur</h2>
            <form method="post" action="">
                <div class="form-group">
                    <input type="text" name="idUtilisateur" class="form-control" placeholder="ID de l'utilisateur" required>
                </div>
                <div class="form-group">
                    <input type="text" name="nouveauNomUtilisateur" class="form-control" placeholder="Nouveau nom de l'utilisateur" required>
                </div>
                <!-- Autres champs d'utilisateur à modifier -->
                <button type="submit" name="modifierUtilisateur" class="btn btn-primary">Modifier</button>
            </form>
        </div>

        <div class="form-container">
            <h2>Supprimer un utilisateur</h2>
            <form method="post" action="">
                <div class="form-group">
                    <input type="text" name="idUtilisateur" class="form-control" placeholder="ID de l'utilisateur" required>
                </div>
                <button type="submit" name="supprimerUtilisateur" class="btn btn-danger">Supprimer</button>
            </form>
        </div>

        <div class="form-container">
            <h2>Ajouter un hôpital</h2>
            <form method="post" action="">
                <div class="form-group">
                    <input type="text" name="nomHopital" class="form-control" placeholder="Nom de l'hôpital" required>
                </div>
                <!-- Autres champs d'hôpital à ajouter -->
                <button type="submit" name="ajouterHopital" class="btn btn-primary">Ajouter</button>
            </form>
        </div>

        <div class="form-container">
            <h2>Modifier un hôpital</h2>
            <form method="post" action="">
                <div class="form-group">
                    <input type="text" name="idHopital" class="form-control" placeholder="ID de l'hôpital" required>
                </div>
                <div class="form-group">
                    <input type="text" name="nouveauNomHopital" class="form-control" placeholder="Nouveau nom de l'hôpital" required>
                </div>
                <!-- Autres champs d'hôpital à modifier -->
                <button type="submit" name="modifierHopital" class="btn btn-primary">Modifier</button>
            </form>
        </div>

        <div class="form-container">
            <h2>Supprimer un hôpital</h2>
            <form method="post" action="">
                <div class="form-group">
                    <input type="text" name="idHopital" class="form-control" placeholder="ID de l'hôpital" required>
                </div>
                <button type="submit" name="supprimerHopital" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>