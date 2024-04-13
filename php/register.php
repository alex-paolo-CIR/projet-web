<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
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
        form {
            width:50%;
            margin: 0 auto 10px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            padding-top: 8px;
        }
        input[type="email"], input[type="text"], input[type="password"], input[type="submit"] {
            background-color: #fff;
            width: 100%;
            padding-top: 8px;
            padding-bottom: 8px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-right: 10px;
            justify-content: center;
        }
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #555;
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

        /* adapter pour mobile */
        @media screen and (max-width: 768px){
            form{
                width: 80%;
            }
            .wallpaper{
                object-fit: cover;
                object-position: 0 0;
            }
        }
    </style>
<body>
<img src="../images/accueil/accueil.jpg" alt="wallpaper" class="wallpaper">
    <h2>Inscription</h2>
    <form method="post" action="register.php">
        <label for="nom">Nom :</label><br>
        <input type="text" id="nom" name="nom" required><br>
        <label for="prenom">Prénom :</label><br>
        <input type="text" id="prenom" name="prenom" required><br>
        <label for="numTel">Numéro de téléphone :</label><br>
        <input type="text" id="numTel" name="numTel" required><br>
        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Mot de passe :</label><br>
        <input type="password" id="password" name="password" required><br>
        <label for="genre">Genre :</label><br>
        <select id="genre" name="genre" required>
            <option value="0">Homme</option>
            <option value="1">Femme</option>
        </select><br>
        <label for="dateNaissance">Date de naissance :</label><br>
        <input type="date" id="dateNaissance" name="dateNaissance" required><br><br>
        <input type="submit" value="S'inscrire">
    </form>

    <?php
include 'paramCompte.php'; // Inclusion du fichier de paramètres de connexion

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $numTel = $_POST['numTel'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $genre = $_POST['genre'];
    $dateNaissance = $_POST['dateNaissance'];

    // Création d'une nouvelle connexion MySQLi en utilisant les informations de paramCompte.php
    $conn = new mysqli($host, $user, $pass, $db);
    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Préparation de la requête SQL
    $sql = "INSERT INTO compteclient (ID, Nom, Prenom, numTel, email, password, genre, dateNaissance) 
            VALUES (NULL, '$nom', '$prenom', '$numTel', '$email', '$password', '$genre', '$dateNaissance')";

    // Exécution de la requête SQL
    if ($conn->query($sql) === TRUE) {
        echo "
        <!-- Affichage d'un message sur tout l'écran de succès -->
        <div style='position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); color: white; font-size: 30px; text-align: center; padding-top: 20%;'>
            Inscription réussie
        </div>
        ";
        // wait for 3 seconds
        header("refresh:3;url=choiceCompte.php");
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }

    // Fermeture de la connexion
    $conn->close();
}
?>

</body>
</html>
