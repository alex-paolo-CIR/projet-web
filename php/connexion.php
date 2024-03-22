<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            background-color: gray;
        }
    </style>
    <title>Document</title>

</head>
<body>

    <style>
        body{
            background-color: gray;
        }
    </style>

<form method="post" action="../php/connexion.php" enctype="multipart/form-data">
    <fieldset>
        <legend>Informations sur vous</legend>
        
        <label required >Civilité :</label>
        <input type="radio" name="civilite" id="male" value="M"/><label for="male">Monsieur</label>
        <input type="radio" name="civilite" id="female" value="Mme"/><label for="female">Madame</label>
        <input type="radio" name="civilite" id="female" value="Mme"/><label for="female">Autre</label>
        
        <hr>
        <label for="prenom">Préom :</label>
        <input type="text" name="prenom" id="prenom" required/> <span class="error">* <z?php echo $prenomErr;?></span>

        <hr>
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required/> <span class="error">* <?php echo $nomErr;?></span>

        <hr>
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" placeholder="prenom.nom@student.junia.com" required pattern ="^[a-zA-Z.-]+@[a-zA-Z.]+junia.com$"/> <span class="error">* <?php echo $emailErr;?></span>
        
        <hr>
        <label for="tel">Téléphone :</label>
        <input type="tel" name="tel" id="tel" placeholder="0xxxxxxxxx" pattern = "[a-zA-Z-' ]"/> <span class="error">* <?php echo $telErr;?></span>
        
        <hr>
        <label for="dnaissance">Date de naissance :</label>
        <input type="date" name="dnaissance" id="dnaissance" /> <span class="error">* <?php echo $dnaissanceErr;?></span>

        <hr>
        <input type="submit" name="Envoyer" Value="Envoyer le formulaire"/>
        <input type="reset" name="Vider" Value="Vider le formulaire"/>
        
    </fieldset>
</form>

<?php

//Ici: Fonctions pour valider les champs
function nettoyer_donnees($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;	
}

//Le nom ne peut contenir que des lettres, espace, tiret ou apostrophe, et ne doit pas dépasser 40 caractères.
function valider_NomPrenom($NomPrenom){
    if (preg_match("/[a-zA-Z-' ]/",$NomPrenom) && strlen($NomPrenom) <= 40){
        return true;
    }
    return false;
}

function valider_email($email){
    if(preg_match("/^[a-zA-Z.-]+@[a-zA-Z.]+./", $email)){
        return true;
    }
    return false;
}	
//Le numéro de téléphone doit contenir 10 chiffre commençant par 0 (on peut accepter des espaces).
function valider_Telephone($tel){
    if(preg_match("/^0[0-9]{9}$/", $tel)){
        return true;
    }
    return false;
}

//on valide la date de naissance si elle est inférieure à la date actuelle et si l'utilisateur a plus de 16 ans
function valider_DateNaissance($dnaissance){
    $dateActuelle = date("Y-m-d");
    $dateNaissance = date($dnaissance);
    $age = date_diff($dateActuelle, $dateNaissance);
    if($dateNaissance < $dateActuelle && $age > 16){
        return true;
    }
    return false;
}

//Tests bouton envoyer et methode POST
// if (!isset($_POST['Envoyer']) && $_SERVER['REQUEST_METHOD'] != 'POST'){
//     header('location:connexion.php');	
// }

// //Tests si champs vides
// if (empty($_POST['civilite']) || empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['tel']) || empty($_POST['dnaissance'])){
//     header('location:connexion.php');
// }


//on recupère les données d'une façon sécurisée
$vCivilite = nettoyer_donnees($_POST['civilite']);
$vNom = nettoyer_donnees($_POST['nom']);
$vPrenom = nettoyer_donnees($_POST['prenom']);
$vEmail = nettoyer_donnees($_POST['email']);
$vTel = nettoyer_donnees($_POST['tel']);
$vDnaissance = nettoyer_donnees($_POST['dnaissance']);

//on valide les données
if(valider_NomPrenom($vNom) && valider_NomPrenom($vPrenom) && valider_email($vEmail) && valider_Telephone($vTel) && valider_DateNaissance($vDnaissance)){
    creation_compte($vCivilite, $vNom, $vPrenom, $vEmail, $vTel, $vDnaissance);
}
// else{ 
//     header('location:login.php');
// }
?>

    
</body>
</html>