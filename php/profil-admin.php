<?php
session_start();

include 'paramCompte.php';
include 'fonctionConnexion.php';

// Vérification de l'authentification
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// Vérification si l'utilisateur est administrateur
$isAdmin = false;
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $isAdmin = true;
} else {
    header("location: profil.php");
    exit;
}

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlReservations = "SELECT * FROM reservations";
$resultReservations = $conn->query($sqlReservations);

$reservations = array();

if ($resultReservations->num_rows > 0) {
    while ($row = $resultReservations->fetch_assoc()) {
        $reservations[] = $row;
    }
    $Resa = "RÉSERVATION(S)";
} else {
    $pasResa = "Aucune réservation(s) trouvée.";
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/divers/logo.png" />
    <title>Profil Admin</title>
    <style>
        body {
            font-family: "Rubik", sans-serif;
            background-color: #000;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: white;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-transform: uppercase;
        }

        #container {
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            background-color: #333;
            padding: 20px;
            margin-top: 20px;
            
            margin-left: 10px;
        }

        .containerResa {
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
        }

        table {
            color: white;
            margin-top: 20px;
            border: solid black 1px;
            width: 75%;
            border-collapse: collapse;
            margin-left: auto;
            margin-right: auto;
        }

        th,
        td {
            border: solid white 1px;
            background-color: #333;
            padding-top: 8px;
            padding-bottom: 8px;
            text-align: center;
        }

        th {
            background-color: #333;
            color: white;
        }

        @media screen and (max-width: 768px) {
            #container,
            .containerResa {
                width: 100%;
                float: none;
                margin-right: 0;
            }

            .content {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }

            #container,
            .containerResa {
                margin-top: 20px;
            }

            table {
                width: 100%;
                overflow-x: auto;
                background-color: transparent;
            }
        }
    </style>
</head>

<body>

    <div class="content">
        <div id="container">
            <h2>Profil Admin</h2>
                <a style="
                justify-content: center;
                text-align: center;
                text-decoration: none;
                text-transform: uppercase;
                color: red;
                font-weight: bold;

                display: block;
                "href="logout.php">Déconnexion</a>
        </div>

        <div class="containerResa">
            <h2>
                <?php
                if (isset($Resa)) {
                    echo $Resa;
                } else {
                    echo $pasResa;
                }
                ?>
            </h2>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>N° de réservation</th>
                    <th>Date de réservation</th>
                    <th>Date de départ</th>
                    <th>Nombre de passagers</th>
                    <th>Destination</th>
                    <th>Nombre de bagages</th>
                    <th>Montant total</th>
                    <th>Supprimer</th>
                </tr>
                <?php
                foreach ($reservations as $reservation) {
                    echo "<tr>";
                    echo "<td>" . $reservation['nom'] . "</td>";
                    echo "<td>" . $reservation['id_reservation'] . "</td>";
                    echo "<td>" . $reservation['date_reservation'] . "</td>";
                    echo "<td>" . $reservation['date_depart'] . "</td>";
                    echo "<td>" . $reservation['nb_voyageurs'] . "</td>";
                    echo "<td>" . $reservation['pays'] . "</td>";
                    echo "<td>" . $reservation['nb_bagages'] . "</td>";
                    echo "<td>" . $reservation['montant_total'] . "€</td>";
                    echo "<td><a style='color: RED; font-weight: bold; text-decoration: none;' href='annulerReservation.php?id=" . $reservation['id_reservation'] . "'>X</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>
