<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vos réservations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Vos réservations :</h2>
    <?php
    // Inclure le fichier de paramètres de connexion
    include '../php/paramCompte.php';

    // Connexion à la base de données
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Requête pour récupérer toutes les réservations
    $sql = "SELECT * FROM reservations";
    $result = $conn->query($sql);

    // Vérifier s'il y a des réservations
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Genre</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Pays</th><th>Date de départ</th><th>Durée</th><th>Nombre de voyageurs</th><th>Nombre de bagages</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['genre'] . "</td>";
            echo "<td>" . $row['nom'] . "</td>";
            echo "<td>" . $row['prenom'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['pays'] . "</td>";
            echo "<td>" . $row['date_depart'] . "</td>";
            echo "<td>" . $row['duree'] . "</td>";
            echo "<td>" . $row['nb_voyageurs'] . "</td>";
            echo "<td>" . $row['nb_bagages'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Aucune réservation trouvée.";
    }

    $conn->close();
    ?>
</div>

</body>
</html>
