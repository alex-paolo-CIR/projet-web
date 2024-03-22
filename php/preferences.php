<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
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
    </style>
</head>
<body>

<h1>Votre compte a été créé avec succès</h1>
<p>Afin de pouvoir améliorer votre expérience sur notre site, nous vous proposons de répondre à ce questionnaire. Il permettra de vous proposer des destinations qui vous correspondent le mieux.</p>

<!-- Bouton qui permet de revenir à la page d'accueil -->
<button onclick="afficherConfirmation()">Retour à l'accueil</button>

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
