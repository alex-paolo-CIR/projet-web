<?php
// Inclure le fichier de paramètres de connexion
include '../php/paramCompte.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Récupérer les données du formulaire
    $genre = $_POST['sexz'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $pays = $_POST['pays'];
    $date_depart = $_POST['date'];
    $duree = $_POST['duree'];
    $nb_voyageurs = $_POST['nbVoyageurs'];
    $nb_bagages = $_POST['nbBagages'];

    // Préparer la requête d'insertion
    $sql = "INSERT INTO reservations (genre, nom, prenom, email, pays, date_depart, duree, nb_voyageurs, nb_bagages) 
            VALUES ('$genre', '$nom', '$prenom', '$email', '$pays', '$date_depart', $duree, $nb_voyageurs, $nb_bagages)";

    if ($conn->query($sql) === TRUE) {
        echo "            <div style='position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.7); color: white; font-size: 30px; text-align: center; padding-top: 20%; z-index: 999;
        '>
        Réservation créer ! Bon voyage !
    </div>";
        // Rediriger l'utilisateur vers la page d'accueil apres 2 secondes
        header("refresh:2;url=../index.php");
    } else {
        echo "Erreur lors de la réservation: " . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="../styles/style.css" />
    <link rel="icon" href="../images/divers/logo.png" />
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <!--lien pour les icones-->
    <title>Réservation</title>
</head>
<body id="Resa">
    <!-- OVERLAY POUR ASSOMBRIR NOTRE BACKGROUND -->
    <div style="position: relative; z-index: 2">
        <!--cette div met tout le code au dessus de l'overlay pour que ça ne sois pas grisatre-->
        <main id="ResaMain" style="margin-right:60px; margin-left: 60px; padding: 20px; border-radius: 5px; background-color: rgba(0, 0, 0, 0.562); border: 2px solid white;">
            <h1 id="resah1" style="display: flex; align-items: center; text-align: center; justify-content: center; text-decoration: underline;">
                Réservation de votre voyage
            </h1>
            

            <form id="resaform" method="post">
                <div class="genre">
                    <input type="radio" name="sexz" value="homme" checked>MR.<br>
                    <input type="radio" name="sexz" value="femme">MME<br>
                </div>

                <label id="resalabel" for="nom">Nom</label>
                <input type="text" name="nom" id="nom" required />

                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" required />

                <label for="email">Email</label>
                <input type="email" name="email" id="email" required />

                <label for="pays">Pays</label>
                <select name="pays" id="pays" required>
                    <option value="">Choisissez un pays</option>
                    <option value="argentine">Argentine</option>
                    <option value="france">France</option>
                    <option value="japon">Japon</option>
                    <option value="suede">Suède</option>
                    <option value="tunisie">Tunisie</option>
                </select>

                <br />

                <label for="date">Date de départ</label>
                <input type="date" name="date" id="date" required />

                <!-- duree du séjour mais ne peux pas être négatif (-1) -->
                <label for="duree">Durée du séjour</label>
                <input type="number" name="duree" id="duree" min="1" required />

                <br />

                <!-- nombre de voyageur avec enfant et adultes en html uniquement -->
                <label for="nbVoyageurs">Nombre de voyageurs</label>
                <input type="number" name="nbVoyageurs" id="nbVoyageurs" min="1" required />

                <br />
                <!-- nombre de bagage mais en "select" comme pour les pays -->
                <label for="nbBagages">Nombre de bagages</label>
                <select name="nbBagages" id="nbBagages" required>
                    <option value="">Choisissez un nombre de bagages</option>
                    <option value="1">1 bagage</option>
                    <option value="2">2 bagages</option>
                    <option value="3">3 bagages</option>
                    <option value="4">4 bagages</option>
                    <option value="5">5 bagages</option>
                </select>

                <input type="submit" value="Réserver" />

                <a class="homee" id="backHomee" href="../index.php#ancre_pays"><img src="../images/divers/backHome.png" /></a>
            </form>

            <a class="menu"><img src="../images/divers/menu-principal.png" /></a>

            <nav class="dropdown">
                <div class="dropdown-content">
                    <a href="../html/france.html">FRANCE</a>
                    <a href="../html/argentine.html">ARGENTINE</a>
                    <a href="../html/japon.html">JAPON</a>
                    <a href="../html/suede.html">SUEDE</a>
                    <a href="../html/tunisie.html">TUNISIE</a>
                </div>
            </nav>
        </main>
    </div>
</body>
</html>
