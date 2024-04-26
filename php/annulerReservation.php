<?php
include "paramCompte.php";
include "fonctionConnexion.php";

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit();
}

if (isset($_GET["id"])) {
    $reservation_id = $_GET["id"];

    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM reservations WHERE id_reservation=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $reservation_id);

    if ($stmt->execute()) {
        echo "Réservation annulée avec succès.";
        header("location: profil.php");
        exit();
    } else {
        echo "Une erreur s'est produite lors de l'annulation de la réservation.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID de réservation non spécifié.";
}
?>
