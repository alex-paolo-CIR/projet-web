<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Préférence Client</title>
    <style>
        .wallpaper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .wallpaper img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
            /* assombrir limage */
            filter: brightness(40%);
        }
        /* Style pour la boîte de dialogue modale */

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            text-align: center;
        }

        .modal-btn {
            margin-top: 10px;
        }

        /* Style pour le formulaire */

        body {
            font-family: "Rubik", sans-serif;
            background-color: black;
        }

        h1 {
            text-align: center;
            color: white;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-transform: uppercase;
            margin-top: 4%;
        }

        p {
            text-align: center;
            color: white;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            margin-top: 10px;
        }

        button {
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

        button:hover {
            background-color: #555;
        }

        form {
            width: 50%;
            margin: 0 auto 10px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        fieldset {
            border: none;
        }

        legend {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        select, input[type="number"] {
            background-color: #fff;
            width: 100%;
            padding-top: 8px;
            padding-bottom: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
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


        
    </style>
</head>
<body>


<!-- wallpaper -->
<div class="wallpaper">
    <img src="../images/accueil/accueil.jpg" alt="wallpaper">
</div>


<h1>Votre compte a été créé avec succès</h1>
<p>Afin de pouvoir améliorer votre expérience sur notre site, nous vous proposons de répondre à ce questionnaire. 
<!-- saut d eligne -->
<br>
Il permettra de vous proposer des destinations qui vous correspondent le mieux.</p>

<!-- Bouton qui permet de revenir à la page d'accueil -->
<button onclick="afficherConfirmation()">Retour à l'accueil</button>
<br>

<!-- Boîte de dialogue modale -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <p>Êtes-vous sûr de vouloir retourner à l'accueil ? Vous ne pourrez plus accéder à ce formulaire.</p>
        <button class="modal-btn" onclick="window.location.href='../index.html'">Oui</button>
        <button class="modal-btn" onclick="fermerConfirmation()">Retour</button>
    </div>
</div>

<form action="preferences.php">
    <fieldset>
        <legend>Préférences</legend>
        <label for="continent">Continent</label>
        <select name="continent" id="continent">
            <option value="Europe">Europe</option>
            <option value="Afrique">Afrique</option>
            <option value="Asie">Asie</option>
            <option value="Amérique">Amérique</option>
            <option value="Océanie">Océanie</option>
        </select>
        <label for="type">Type de voyage</label>
        <select name="type" id="type">
            <option value="Aventure">Aventure</option>
            <option value="Culturel">Culturel</option>
            <option value="Détente">Détente</option>
            <option value="Sportif">Sportif</option>
        </select>
        <label for="budget">Budget</label>
        <input type="number" name="budget" id="budget" required>
        <label for="duree">Durée</label>
        <input type="number" name="duree" id="duree" required>
        <input type="submit" value="Envoyer">
    </fieldset>
</form>

<script>
    // Fonction pour afficher la boîte de dialogue modale
    function afficherConfirmation() {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
    }

    // Fonction pour fermer la boîte de dialogue modale
    function fermerConfirmation() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }
</script>
    
</body>
</html>
