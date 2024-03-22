<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

//on crée les varriables pour les messages d'erreurs
$emailErr = $passwordErr = "";


?>

<h2>connexion</h2>
<div>
    <h3>Connectez vous</h3>
    <form action="connexion.php" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>* <span><?php echo $emailErr; ?></span>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required>* <span><?php echo $passwordErr; ?></span>
        <input type="submit" value="Se connecter">
    </form>
</div>
</body>



</html>

<?php

//on récupère les données du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];
    //on vérifie si les champs sont vides
    if (empty($email)){
        $emailErr = "L'email est obligatoire";
    }
    if (empty($password)){
        $passwordErr = "Le mot de passe est obligatoire";
    }
    //on vérifie si l'email est valide
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailErr = "L'email n'est pas valide";
    }
    //on vérifie si le mot de passe est valide
    if (!empty($password) && strlen($password) < 8){
        $passwordErr = "Le mot de passe doit contenir au moins 8 caractères";
    }
    //on vérifie si les champs sont valides
    if (empty($emailErr) && empty($passwordErr)){
        //on se connecte à la base de données
        $connexion = mysqli_connect('localhost', 'root', '', 'tp2');
        //on vérifie si la connexion est établie
        if (!$connexion){
            die('Erreur de connexion ('.mysqli_connect_errno().')'.mysqli_connect_error());
        }
        //on prépare la requête
        $requete = "SELECT * FROM utilisateurs WHERE email = '$email' AND password = '$password'";
        //on exécute la requête
        $resultat = mysqli_query($connexion, $requete);
        //on vérifie si la requête a retourné un résultat
        if (mysqli_num_rows($resultat) == 1){
            //on redirige l'utilisateur vers la page d'accueil
            header('location:accueil.php');
        }else{
            //on affiche un message d'erreur
            echo "Email ou mot de passe incorrect";
        }
        //on ferme la connexion
        mysqli_close($connexion);
    }
}


?>