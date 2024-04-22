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
    $dateActuelle = new DateTime();
    $dateNaissance = new DateTime($dnaissance);
    $age = $dateActuelle->diff($dateNaissance)->y;
    if($dateNaissance < $dateActuelle && $age > 16){
        return true;
    }
    return false;
}

function valider_photoProfil($photoProfil){
    $tailleMax = 10000000000;
    $extensionsValides = array('jpg', 'jpeg', 'png', 'gif');
    if($photoProfil['size'] <= $tailleMax){
        $extensionUpload = strtolower(substr(strrchr($photoProfil['name'], '.'), 1));
        if(in_array($extensionUpload, $extensionsValides)){
            return true;
        }
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
// $vCivilite = nettoyer_donnees($_POST['civilite']);
// $vNom = nettoyer_donnees($_POST['nom']);
// $vPrenom = nettoyer_donnees($_POST['prenom']);
// $vEmail = nettoyer_donnees($_POST['email']);
// $vTel = nettoyer_donnees($_POST['tel']);
// $vDnaissance = nettoyer_donnees($_POST['dnaissance']);

// //on valide les données
// if(valider_NomPrenom($vNom) && valider_NomPrenom($vPrenom) && valider_email($vEmail) && valider_Telephone($vTel) && valider_DateNaissance($vDnaissance)){
//     creationCompte($vCivilite, $vNom, $vPrenom, $vEmail, $vTel, $vDnaissance);
// }

?>