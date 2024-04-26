<?php
// Inclusion du fichier de paramètres de connexion
include 'paramCompte.php';
// Inclusion du fichier de fonctions de connexion
include 'fonctionConnexion.php';

// Vérification si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// Vérification si l'ID de la réservation est passé en paramètre
if (isset($_GET['id'])) {
    $reservation_id = $_GET['id'];

    // Connexion à la base de données
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Suppression de la réservation de la base de données
    $sql = 'DELETE FROM reservations WHERE id_reservation=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $reservation_id);
    
    if ($stmt->execute()) {
        echo "Réservation annulée avec succès.";
        header("location: profil.php");
        exit;
    } else {
        echo "Une erreur s'est produite lors de l'annulation de la réservation.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID de réservation non spécifié.";
}
?>
