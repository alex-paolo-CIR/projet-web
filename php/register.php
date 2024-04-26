<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/divers/logo.png" />
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
            width: 50%;
            margin: 0 auto 10px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            padding-top: 1px;
            margin-bottom: 4px; /* Facultatif : réduire l'espace entre les champs */
        }
        input[type="email"],
        input[type="text"],
        input[type="password"],
        input[type="submit"],
        input[type="date"],
        select {
            background-color: #fff;
            width: 100%;
            padding-top: 8px;
            padding-bottom: 8px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-right: 10px;
        }
        select {
            margin-bottom: 10px;
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
            form {
                width: 80%;
            }
            .wallpaper {
                object-fit: cover;
                object-position: 0 0;
            }
        }
        /* css pr les boutons options mets les cote a cote */
        .buttonOpt {
            margin-top: 10px;
            display: flex;
            justify-content: space-around;
        }
        .buttonOpt button {
            background-color: #333;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
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
include 'fonctionConnexion.php'; // Inclusion du fichier de fonctions de connexion

$nomErr = $prenomErr = $numTelErr = $emailErr = $passwordErr = $dateNaissanceErr = $photoErr = "";

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

    // check si il n'y a pas d ephoto de profil uploadée et si c'est le cas, on met la photo default de profil
    if ($_FILES["photoProfil"]["error"] == UPLOAD_ERR_NO_FILE) {
        $photoPath = "uploads/default.jpg";
    } else {
         // Traitement de la photo de profil
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photoProfil"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $photoPath = "";

    // renommer l'image par le nom + 1eere lettre prenom + date de naissance
    $target_file = $target_dir . $nom . substr($prenom, 0, 1) . $dateNaissance . "." . $imageFileType;
    
    if(isset($_FILES["photoProfil"]) && $_FILES["photoProfil"]["error"] == UPLOAD_ERR_OK) {
        $photoPath = $target_file;
    } else {
        $photoErr = "Erreur lors du téléchargement de la photo de profil.";
    }

    // Vérifie si le fichier image est une image réelle ou une fausse image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["photoProfil"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $photoErr = "Le fichier n'est pas une image.";
            $uploadOk = 0;
        }
    }
    
    // Vérifie si le fichier existe déjà
    if (file_exists($target_file)) {
        $photoErr = "Désolé, le fichier existe déjà.";
        $uploadOk = 0;
    }
    
    // Vérifie la taille de l'image
    if ($_FILES["photoProfil"]["size"] > 500000) {
        $photoErr = "Désolé, votre fichier est trop volumineux.";
        $uploadOk = 0;
    }
    
    // Autorise certains formats de fichiers
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $photoErr = "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
        $uploadOk = 0;
    }
    
    // Vérifie si $uploadOk est défini à 0 par une erreur
    if ($uploadOk == 0) {
        $photoErr = "Désolé, votre fichier n'a pas été téléchargé.";
    // si tout est ok, essaie de télécharger le fichier
    } else {
        if (move_uploaded_file($_FILES["photoProfil"]["tmp_name"], $target_file)) {
            $photoPath = $target_file; // Chemin d'accès à enregistrer dans la base de données
        } else {
            $photoErr = "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
        }
    }
    }
   

    // Préparation de la requête SQL
    $sql = "INSERT INTO compteclient (ID, Nom, Prenom, numTel, email, password, genre, dateNaissance, photoProfil) 
        VALUES (NULL, '$nom', '$prenom', '$numTel', '$email', '$password', '$genre', '$dateNaissance', '$photoPath')";

    // checker si le mot de passe est bien sécurisé avec des chiffres et des lettres caractères spéciaux, etc.
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
        $passwordErr = "Le mot de passe doit contenir au moins 8 caractères, dont au moins une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial.";
    }

    // checker si l'email est bien un email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "L'adresse email n'est pas valide.";
    }

    // CHECK SI EMAIL DEJA PRISE
    $sql_email = "SELECT email FROM compteclient WHERE email = '$email'";
    $result_email = $conn->query($sql_email);
    if ($result_email->num_rows > 0) {
        $emailErr = "L'adresse email est déjà utilisée.";
    }
    

    // checker si le nom est bien un nom
    if (!preg_match("/^[a-zA-Z-' ]*$/", $nom)) {
        $nomErr = "Le nom ne peut contenir que des lettres, des espaces, des tirets et des apostrophes.";
    }

    // checker si le prénom est bien un prénom
    if (!preg_match("/^[a-zA-Z-' ]*$/", $prenom)) {
        $prenomErr = "Le prénom ne peut contenir que des lettres, des espaces, des tirets et des apostrophes.";
    }





    // checker si le numéro de téléphone est bien un numéro de téléphone
    if (!preg_match("/^[0-9]{10}$/", $numTel)) {
        $numTelErr = "Le numéro de téléphone doit contenir 10 chiffres.";
    }

    // checker si la date de naissance est bien une date de naissance valide avec fonction valider_DateNaissance
    if (!valider_DateNaissance($dateNaissance)) {
        $dateNaissanceErr = "La date de naissance n'est pas valide. L'âge minimum requis est 16 ans.";
    }

    // Exécution de la requête SQL si aucun message d'erreur
    if (empty($nomErr) && empty($prenomErr) && empty($numTelErr) && empty($emailErr) && empty($passwordErr) && empty($dateNaissanceErr) && empty($photoErr)) {
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
<form method="post" action="register.php" enctype="multipart/form-data">
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

    <!-- photo de profil avec css pour pp ronde -->
    <label for="photoProfil">Photo de profil :</label><br>
    <input type="file" id="photoProfil" name="photoProfil"><br><br>
    <span class="error"><?php echo $photoErr;?></span><br><br>

    <input type="submit" value="S'inscrire">

    <!-- Boutons pour "déjà un compte" et formulaire de préférence -->
    <div class="buttonOpt">
        <button onclick="window.location.href='login.php'">Déjà un compte ?</button>
        <button onclick="window.location.href='preferences.php'">Formulaire préférences</button>
    </div>
</form>
</body>
</html>
