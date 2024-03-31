<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JART &copy; - Connexion</title>
    <style>
        body{
            font-family: "Rubik", sans-serif;
            background-color: #f4f4f4;
        }
        h2{
            text-align: center;
            color: white;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
            filter: brightness(50%);
        }
        #connect {
            width: 100%;
            overflow: hidden;
        }
        .links {
            display: block;
            float: left;
            width: 1;
            margin-left: 16%;
            margin-top: 50px;
        }
        .links a {
            display: block;
            width: 50%;
            margin: 0 auto;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #333;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .links a:hover {
            background-color: #555;
        }
        .center-form {
            float: right;
            width: 33%;
            margin-right: 32%;
        }
    </style>
</head>
<body>
    <img src="../images/divers/resa.jpg" alt="wallpaper" class="wallpaper">
    <?php
    $emailErr = $passwordErr = "";
    ?>
    <h2>Connectez-vous</h2>
    <div id="connect">
        <div class="links">
            <a href="preferences.php" class="left-link">Formulaire préférences</a>
            <a href="connexion.php" class="left-link">Créer un compte</a>
        </div>
        <form action="connexion.php" method="post" class="center-form">
            <label for="email">Email*</label>
            <input type="email" name="email" id="email" required> <span><?php echo $emailErr; ?></span>
            <label for="password">Mot de passe*</label>
            <input type="password" name="password" id="password" required>*: Champs obligatoire <br><br><span><?php echo $passwordErr; ?></span>
            <input type="submit" value="Se connecter">
        </form>
    </div>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email)){
        $emailErr = "L'email est obligatoire";
    }
    if (empty($password)){
        $passwordErr = "Le mot de passe est obligatoire";
    }
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailErr = "L'email n'est pas valide";
    }
    if (!empty($password) && strlen($password) < 8){
        $passwordErr = "Le mot de passe doit contenir au moins 8 caractères";
    }
    if (empty($emailErr) && empty($passwordErr)){
        $connexion = mysqli_connect('localhost', 'root', '', 'tp2');
        if (!$connexion){
            die('Erreur de connexion ('.mysqli_connect_errno().')'.mysqli_connect_error());
        }
        $requete = "SELECT * FROM utilisateurs WHERE email = '$email' AND password = '$password'";
        $resultat = mysqli_query($connexion, $requete);
        if (mysqli_num_rows($resultat) == 1){
            header('location:accueil.php');
        }else{
            echo "Email ou mot de passe incorrect";
        }
        mysqli_close($connexion);
    }
}


?>