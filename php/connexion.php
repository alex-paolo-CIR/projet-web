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
        span{
            color : red;
        }
    </style>

<?php
		$emailErr = $telErr = $photoErr = $CiviliteErr = $prenomErr = $nomErr = $dnaissanceErr = $filiereErr = $sportsErr =" ";
		if (empty($_POST['civilite'])){
			$CiviliteErr = "La civilité est obligatoire";
		}
		if (empty($_POST['prenom'])){
			$prenomErr = "Le prénom est obligatoire";
		}
		if (empty($_POST['nom'])){
			$nomErr = "Le nom est obligatoire";
		}
		if (empty($_POST['email'])){
			$emailErr = "L'email est obligatoire";
		}
		if (empty($_POST['tel'])){
			$telErr = "Le téléphone est obligatoire";
		}
		if (empty($_POST['dnaissance'])){
			$dnaissanceErr = "La date de naissance est obligatoire";
		}
		if (empty($_POST['filiere'])){
			$filiereErr = "La filière est obligatoire";
		}
		if (empty($_POST['sports'])){
			$sportsErr = "Le sport est obligatoire";
		}
		if (empty($_FILES['photo'])){
			$photoErr = "La photo est obligatoire";
		}
		?>

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



    
</body>
</html>