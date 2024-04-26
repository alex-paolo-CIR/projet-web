<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/divers/logo.png" />
    <title>JART &copy; - Connexion</title>
    <style>
        body{
            font-family: "Rubik", sans-serif;
            background-color: #f4f4f4;
        }
        h2{
            text-align: center;
            color: white;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-transform: uppercase;
            margin-top: 10%;
        }
        form{
            width:50%;
            margin: 0 auto 10px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label{
            display: block;
            margin-bottom: 5px;
        }
        input[type="email"], input[type="password"], input[type="submit"]{
            background-color: #fff;
            width: 100%;
            padding-top: 8px;
            padding-bottom: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-right: 10px;
            justify-content: center;
        }
        input[type="submit"]{
            background-color: #333;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
        }
        input[type="submit"]:hover{
            background-color: #555;
        }
        span{
            color: red;
        }
        a{
            display: inline-block;
            width: 10%;
            margin: 0;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #333;
            border-radius: 5px;
        }
        a:hover{
            background-color: #555;
        }
        a + a{
            margin-top: 10px;
        }
        .wallpaper{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
            filter: brightness(40%);
        }
        #connect {
            width: 100%;
            overflow: hidden;
        }
        .links a {
            display: block;
            width: 30%;
            margin: 0 auto;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #333;
            border-radius: 10px;
            margin-bottom: 10px;
            font-size: 0.9em;
        }
        .links a:hover {
            background-color: #555;
        }
        .center-form {
            float: right;
            width: 33%;
            margin-right: 32%;
        }


        input[type="checkbox"]{
            display: inline-block;
        }
        label[for="remember"]{
            display: inline-block;
            width: 50%;
            font-size: 0.8em;
            position: relative;
            top: -2px;
        }
        

        /* adapter pour mobile */
        @media screen and (max-width: 768px){
            form{
                width: 80%;
            }
            .center-form{
                width: 80%;
                margin-right:5%;
            }
            .links{
                width: 80%;
                margin-left: 10%;
            }

            /* adapter le fond decran pour mobile, zoomer sur une partie du fond d'écran */
            .wallpaper{
                object-fit: cover;
                object-position: 0 0;
            }
         


        }
       
    </style>
</head>
<body>
    <img src="../images/accueil/accueil.jpg" alt="wallpaper" class="wallpaper">
    
    <?php
    require_once('paramCompte.php');

    session_start();

    $emailErr = $passwordErr = "";

    // check si deja connecté
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        header("Location: profil.php");
        exit;
    }

    // Vérification de l'envoi du formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $email = nettoyer_donnees($_POST['email']);
        $password = $_POST['password'];

        // Connexion à la base de données
        $conn = new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT password FROM compteclient WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];
        
            if ($password === $stored_password) {
                echo "<div style='position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.7); color: white; font-size: 30px; text-align: center; padding-top: 20%; z-index: 999;'>
                Connexion réussie ! Redirection en cours...
            </div>";
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                // requete sql pour avoir l'id et lattribué à la session
                $sql_id = "SELECT ID FROM compteclient WHERE email = ?";
                $stmt_id = $conn->prepare($sql_id);
                $stmt_id->bind_param("s", $email);
                $stmt_id->execute();
                $result_id = $stmt_id->get_result();
        
                if ($result_id->num_rows > 0) {
                    $row_id = $result_id->fetch_assoc();
                    $_SESSION['id'] = $row_id['ID']; // Attribuer l'ID à la session
                }
                
                if(isset($_POST['remember'])){
                    setcookie('email', $email, time() + 3600 * 24 * 30);
                    setcookie('password', $password, time() + 3600 * 24 * 30);
                }

                // Vérification si l'utilisateur est admin donc son id est le 1

                if($_SESSION['id'] === 1){
                    $_SESSION['role'] = 'admin';
                    header("refresh:5;url=profil-admin.php");
                } else {
                    header("refresh:5;url=profil.php");
                }
            } else {
                $passwordErr = "Mot de passe incorrect";
            }
        } else {
            $emailErr = "Email non trouvé";
        }
        

        $stmt->close();
        $conn->close();
    }

    // Fonction pour nettoyer les données
    function nettoyer_donnees($donnees) {
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }
    ?>

    <h2>Connectez-vous</h2>
    <div id="connect">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="center-form">
            <label for="email">Email*</label>
            <input type="email" name="email" id="email" required>
            <span class="error"><?php echo $emailErr; ?></span> <!-- Affichez le message d'erreur ici -->
            
            <label for="password">Mot de passe*</label>
            <input type="password" name="password" id="password" required>
            <span class="error"><?php echo $passwordErr; ?></span> <!-- Affichez le message d'erreur ici -->

            <br>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Se souvenir de moi</label>
            
            <input type="submit" value="Se connecter">
        </form>
    </div>
    <div class="links">
            <a href="register.php" class="left-link">Pas de compte ? Créez-en un !</a>
            <a href="../index.php" class="left-link">Accueil</a>
        </div>
</body>
</html>
