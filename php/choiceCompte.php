<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>

<?php

//on crée les varriables pour les messages d'erreurs
$emailErr = $passwordErr = $erreurCO ="";


?>

<a href="preferences.php">Formulaire préférences</a>
<a href="connexion.php">Créer un compte</a>

<style>
    div{
        display: flex;
        flex-direction: column;
        width: 30%;
    }
    form{
        display: flex;
        flex-direction: column;
    }
    
</style>

<h2>Connexion</h2>
<div>
    <h3>Connectez vous</h3>
    <p>Les champs marqués d'un * sont obligatoires</p>
    <span><?php echo $erreurCO ?></span>
    <form action="choiceCompte.php" method="post">
        <label for="email">Email *</label><span><?php echo $emailErr; ?></span>
        <input type="email" name="email" id="email" required>
        <label for="password">Mot de passe *</label><span><?php echo $passwordErr; ?></span>
        <input type="password" name="password" id="password" required>
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
    if (!empty($emailErr) && !empty($passwordErr)){
        
        try{
			require("paramCompte.php");               
			
			//on prépare la requête
            $requete = "SELECT * FROM compteclient WHERE email = '$email' AND password = '$password'";
			$req = $conn->prepare($requete);
			$req->execute(array('email' => $email, 'password' => $password));

            //on récupère les données de l'utilisateur
            $resultat = $req->fetch();
            $email = $resultat['email'];
            $password = $resultat['password'];
        
            //on ferme la connexion
			$conn= NULL;
			header("Location:./index.html");
		}                 
		catch(Exception $e){
			die("Erreur : " . $e->getMessage());
            $erreurCO = "L'email ou le mot de passe est incorrect";
        }
    }
}
?>