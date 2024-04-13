<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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


        /* css pr les boutons options mets les cote a cote */
        .buttonOpt {
            color: #fff;
            cursor: pointer;
            font-weight: bold;
            margin: 0 auto;
            padding: 10px;
            border: none;
            border-radius: 10px;
            margin-top: 10px;
            justify-content: center;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        .buttonOpt button {
            background-color: #333;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
            margin: 0 auto;
            display: block;
            padding: 10px;
            border: none;
            border-radius: 10px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
<?php
include 'paramCompte.php'; // Inclusion du fichier de paramètres de connexion

$nomErr = $prenomErr = $numTelErr = $emailErr = $passwordErr = $dateNaissanceErr = "";

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

    // checker si le mot de passe est bien sécurisé avec des chiffres et des lettres caractères spéciaux, etc.
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
        $passwordErr = "Le mot de passe doit contenir au moins 8 caractères, dont au moins une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial.";
    }

    // checker si l'email est bien un email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "L'adresse email n'est pas valide.";
    }

    // checker si le numéro de téléphone est bien un numéro de téléphone
    if (!preg_match("/^[0-9]{10}$/", $numTel)) {
        $numTelErr = "Le numéro de téléphone doit contenir 10 chiffres.";
    }

    // checker si la date de naissance est bien une date de naissance valide
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $dateNaissance)) {
        $dateNaissanceErr = "La date de naissance n'est pas valide.";
    }

    // Exécution de la requête SQL si aucun message d'erreur
    if (empty($nomErr) && empty($prenomErr) && empty($numTelErr) && empty($emailErr) && empty($passwordErr) && empty($dateNaissanceErr)) {
        if ($conn->query($sql) === TRUE) {
            echo "
            <!-- Affichage d'un message sur tout l'écran de succès -->
            <div style='position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); color: white; font-size: 30px; text-align: center; padding-top: 20%;'>
                Inscription réussie
            </div>
            ";
            // rediriger vers la page de connexion après 3 secondes
            header("refresh:3;url=login.php");
        } else {
            echo "Erreur: " . $sql . "<br>" . $conn->error;
        }
    }

    // Fermeture de la connexion
    $conn->close();
}
?>
<img src="../images/accueil/accueil.jpg" alt="wallpaper" class="wallpaper">
<h2>Inscription</h2>
<form method="post" action="register.php">
    <label for="nom">Nom :</label><br>
    <input type="text" id="nom" name="nom" required><br>
    <span class="error"><?php echo $nomErr;?></span><br>

    <label for="prenom">Prénom :</label><br>
    <input type="text" id="prenom" name="prenom" required><br>
    <span class="error"><?php echo $prenomErr;?></span><br>

    <label for="numTel">Numéro de téléphone :</label><br>
    <input type="text" id="numTel" name="numTel" required><br>
    <span class="error"><?php echo $numTelErr;?></span><br>

    <label for="email">Email :</label><br>
    <input type="email" id="email" name="email" required><br>
    <span class="error"><?php echo $emailErr;?></span><br>

    <label for="password">Mot de passe :</label><br>
    <input type="password" id="password" name="password" required><br>
    <span class="error"><?php echo $passwordErr;?></span><br>

    <label for="genre">Genre :</label><br>
    <select id="genre" name="genre" required>
        <option value="0">Homme</option>
        <option value="1">Femme</option>
    </select><br>

    <label for="dateNaissance">Date de naissance :</label><br>
    <input type="date" id="dateNaissance" name="dateNaissance" required><br>
    <span class="error"><?php echo $dateNaissanceErr;?></span><br><br>

    <input type="submit" value="S'inscrire">

    <!-- Boutons pour "déjà un compte" et formulaire de préférence -->
    <div class="buttonOpt">
        <button onclick="window.location.href='login.php'">Déjà un compte ?</button>
        <button onclick="window.location.href='preferences.php'">Formulaire préférences</button>
    </div>
</form>
</body>
</html>
