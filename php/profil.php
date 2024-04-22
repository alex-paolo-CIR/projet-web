<?php
// Inclusion du fichier de paramètres de connexion
include 'paramCompte.php';
// Inclusion du fichier de fonctions de connexion
include 'fonctionConnexion.php';

// Déclaration des variables pour stocker les éventuelles erreurs
$nomErr = $prenomErr = $numTelErr = $emailErr = $passwordErr = $dateNaissanceErr = $photoErr = "";
$nom = $prenom = $numTel = $email = $password = $genre = $dateNaissance = $photoPath = "";

// Vérification si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// Récupération des informations de l'utilisateur depuis la base de données
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_id = $_SESSION['id'];

$sql = "SELECT * FROM compteclient WHERE ID='$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nom = $row['Nom'];
        $prenom = $row['Prenom'];
        $numTel = $row['numTel'];
        $email = $row['email'];
        $password = $row['password'];
        $genre = $row['genre'];
        $dateNaissance = $row['dateNaissance'];
        $photoPath = $row['photoProfil'];
    }
} else {
    echo "Aucun résultat trouvé.";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <style>
        body {
            font-family: "Rubik", sans-serif;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            color: white;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-transform: uppercase;
            margin-top: 2%;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .wallpaper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
            filter: brightness(40%);
        }

        /* pour pp */
    
        #pp
        {
            /* faire en sorte que ça prenne le centre de l'image et l'arrondi bien comme une pp parfaite */
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
            
        }

        .info {
            margin-bottom: 20px;
        }

        .buttonOpt {
            display: flex;
            justify-content: center;
        }

        .buttonOpt button {
            background-color: #333;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            margin: 0 10px;
        }
    </style>
</head>

<body>
    
<img src="../images/accueil/accueil.jpg" alt="wallpaper" class="wallpaper">
    <h2>Profil</h2>
    <div class="container">
        <img id="pp" src="<?php echo $photoPath ?>" alt="Photo de profil">
        <div class="info">
            <label for="nom">Nom :</label>
            <span><?php echo $nom; ?></span>
        </div>
        <div class="info">
            <label for="prenom">Prénom :</label>
            <span><?php echo $prenom; ?></span>
        </div>
        <div class="info">
            <label for="numTel">Numéro de téléphone :</label>
            <span><?php echo $numTel; ?></span>
        </div>
        <div class="info">
            <label for="email">Email :</label>
            <span><?php echo $email; ?></span>
        </div>
        <div class="info">
            <label for="genre">Genre :</label>
            <span><?php echo ($genre == 0) ? "Homme" : "Femme"; ?></span>
        </div>
        <div class="info">
            <label for="dateNaissance">Date de naissance :</label>
            <span><?php echo $dateNaissance; ?></span>
        </div>
        <div class="buttonOpt">
            <button onclick="window.location.href='edit_profile.php'">Modifier le profil</button>
            <button onclick="window.location.href='logout.php'">Se déconnecter</button>
        </div>
    </div>
    
</body>

</html>
