<?php
// Inclusion du fichier de paramètres de connexion
include "./php/paramCompte.php";
// Inclusion du fichier de fonctions de connexion
include "./php/fonctionConnexion.php";

// Déclaration des variables pour stocker les éventuelles erreurs
$prenom = $photoPath = "";

// Vérification si l'utilisateur est connecté
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // wait 5 sec and alert
    echo '<script>setTimeout(function(){alert("Vous n\'êtes pas connecté. Veuillez vous connecter pour accéder aux fonctionnalités.");}, 5000);</script>';
}
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $user_id = $_SESSION["id"];

    $sql = "SELECT * FROM compteclient WHERE ID='$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $prenom = "Bonjour " . $row["Prenom"] . " !";
            $photoPath = $row["photoProfil"];
        }
    } else {
        echo "Aucun résultat trouvé.";
    }

    $conn->close();
} else {
    // Si l'utilisateur n'est pas connecté, vous pouvez afficher "Mon Compte" à la place du prénom
    $prenom = "Mon Compte";
    // Utiliser la photo de profil par défaut
    $photoPath = "/uploads/defaulti.jpg";
}
?>

<!DOCTYPE html>
<html lang="FR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no"
    />
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/style.php" />
    <link rel="icon" href="./images/divers/logo.png" />

    <link
      href="https://fonts.googleapis.com/css?family=Oswald"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Rubik"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />  
    <!--lien pour les icones-->
    <title>JART &copy; - Accueil</title>

  </head>

  <body id="Accueil">
    <div class="overlay"></div>
    <!-- OVERLAY POUR ASSOMBRIR NOTRE BACKGROUND -->
    <div style="position: relative; z-index: 2">
      <!--cette div met tout le code au dessus de l'overlay pour que ça ne sois pas grisatre-->
          <header>
            <div id="Titre">
              <h1>LES 5 PAYS À ABSOLUMENT VISITER</h1>
              <br>
              <div
                class="boutton_en_savoir_plus"
                onclick="window.location.href='#presentation'"
              >
                <a href="#" onclick="return false;">En savoir +</a>
              </div>
            </div>
          </header>
          <article>
            <section>
              <div id="presentation">
                <h1 id="presentation_titre">QUE DÉCOUVRIR ?</h1>
                <div class="conteneur_presentation">
                  <div class="conteneur_colone">
                    <div class="categorie_presentation">
                      <img src="./images/accueil/carte.png" alt="icone carte" />
                      <div class="titre_texte">
                        <h3>DESTINATIONS INÉDITES</h3>
                        <p>
                          Grace à nous vous visiterez et découvrirez des
                          endroits extraordinaires et inoubliables
                        </p>
                      </div>
                    </div>
                    <div class="categorie_presentation">
                      <img src="./images/accueil/art.png" alt="icone culture" />
                      <div class="titre_texte">
                        <h3 class="under">DÉCOUVRIR DE NOUVELLES CULTURES</h3>
                        <p>
                          Plongez dans l'univers des pays que vous visitez,
                          tombez sous le charme des histoires culturelle de
                          chacune des destinations.
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="conteneur_colone">
                    <div class="categorie_presentation">
                      <img
                        src="images/accueil/assiette.png"
                        alt="icone restaurant"
                      />
                      <div class="titre_texte">
                        <h3>EXPERIENCES CULINAIRES</h3>
                        <p>
                          Allez goûter les incroyables saveurs de tout ces pays
                          regorgeant de cultures culinaires.
                        </p>
                      </div>
                    </div>
                    <div class="categorie_presentation">
                      <img
                        src="images/accueil/parthenon.png"
                        alt="icone monument"
                      />
                      <div class="titre_texte">
                        <h3 class="under">LES INCONTOURNABLES</h3>
                        <p>
                          Chaque nations possèdent des trésors à absolument
                          expérimentes et à voir de vos propres yeux.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <section id="ancre_pays">
              <h1 id="presentation_titre" style="text-decoration: underline">
                LES MEILLEURES DESTINATIONS
              </h1>
              <div class="conteneur_pays">
                <div class="conteneur_pres">
                  <img
                    class="image_pres"
                    src="images/france/La_Tour_Eiffel.jpg"
                    alt="Paris"
                  />
                </div>
                <div class="conteneur_info_pays">
                  <p class="titre_pays">FRANCE</p>
                  <p>
                    Le pays le plus visité au monde ne l'est pas pour rien ! La
                    variété de paysage, la culture et même sa gastronomie vous
                    surprendront à chaque nouvelle visite.
                  </p>
                  <div class="boutton_decouvrir">
                    <a href="./html/france.html">DÉCOUVRIR LA DESTINATION</a>
                  </div>
                </div>
              </div>
              <div class="conteneur_pays">
                <div class="conteneur_pres">
                  <img
                    class="image_pres"
                    src="./images/argentine/Argentine.png"
                    alt="Argentine"
                  />
                </div>
                <div class="conteneur_info_pays">
                  <p class="titre_pays">ARGENTINE</p>
                  <p>
                    L'Argentine connaît une immense diversité de paysages. En
                    effet, au nord le pays est très désertique tandis qu’au sud,
                    les lacs sont remplis d'immenses glaciers.
                  </p>
                  <div class="boutton_decouvrir">
                    <a href="./html/argentine.html">DÉCOUVRIR LA DESTINATION</a>
                  </div>
                </div>
              </div>
              <div class="conteneur_pays">
                <div class="conteneur_pres">
                  <img
                    class="image_pres"
                    src="images/japon/japonPRES.jpg"
                    alt=" japon"
                  />
                </div>
                <div class="conteneur_info_pays">
                  <p class="titre_pays">JAPON</p>
                  <p>
                    Le Japon, aussi appelé pays du soleil levant est connu pour
                    la richesse de paysage qu'offrent ses campagnes mais aussi
                    ses villes immenses symboles de modernité et d’avancée
                    technologique.
                  </p>
                  <div class="boutton_decouvrir">
                    <a href="./html/japon.html">DÉCOUVRIR LA DESTINATION</a>
                  </div>
                </div>
              </div>
              <div class="conteneur_pays">
                <div class="conteneur_pres">
                  <img
                    class="image_pres"
                    src="./images/suede/suedePres.jpg"
                    alt=" Suede"
                  />
                </div>
                <div class="conteneur_info_pays">
                  <p class="titre_pays">SUEDE</p>
                  <p>
                    La Suède, pays scandinave d'Europe, plaît grâce à sa
                    combinaison entre une nature préservée et une riche histoire
                    culturelle. La Suède offre un paysage diversifié, de lacs
                    étincelants et de côtes donnant sur la mer Baltique.
                  </p>
                  <div class="boutton_decouvrir">
                    <a href="./html/suede.html">DÉCOUVRIR LA DESTINATION</a>
                  </div>
                </div>
              </div>
              <div class="conteneur_pays">
                <div class="conteneur_pres">
                  <img
                    class="image_pres"
                    src="./images/tunisie/acceuilTunisie.jpg"
                    alt=" Namibie"
                  />
                </div>
                <div class="conteneur_info_pays">
                  <p class="titre_pays">TUNISIE</p>
                  <p>
                    La Tunisie est un pays d'Afrique du Nord situé sur la côte
                    méditerranéenne. Il est connu pour ses plages et ses
                    stations balnéaires, telles que celles de Sousse et de
                    Monastir.
                  </p>
                  <div class="boutton_decouvrir">
                    <a href="./html/tunisie.html">DÉCOUVRIR LA DESTINATION</a>
                  </div>
                </div>
              </div>
            </section>
            <h1 id="presentation_titre">SATISFAIT ?</h1>
            <p style="
            display: flex; 
            align-items: center; 
            text-align: center;
            justify-content: center;
            font-size: 1.5em;    
            ">Alors n'attendez plus et réservez dès maintenant !</p>
            <center>
              <a style="
            display: inline-block; 
            text-align: center;" 
            href="./php/reservation.php"><button class="glow-on-hover" type="button">RESERVER</button></a>
          </center>

          </article>  
          <footer>
            <a class="top" href="#"
              ><img src="./images/divers/vers-le-haut.png"
            /></a>
          </footer>

          

          <a class="menu"><img src="./images/divers/globee.png" /></a>

          <nav class="dropdown">
            <div class="dropdown-content">
              <a href="./html/france.html">FRANCE</a>
              <a href="./html/argentine.html">ARGENTINE</a>
              <a href="./html/japon.html">JAPON</a>
              <a href="./html/suede.html">SUEDE</a>
              <a href="./html/tunisie.html">TUNISIE</a>
            </div>
          </nav>

          <a class="buttonResa" style="text-decoration: none;
                padding: 10px;
                font-family: sans-serif;
                background: #868686;
                border-radius: 2em;
                position: fixed;
                top: 50px;
                left: 10px;
                z-index: 999;
                transform: scale(0.55);
                transform-origin: left;
                transition: all 0.3s;
                display: flex;
                align-items: center;
    " href="./php/reservation.php" onmouseover="document.getElementById('textResa').style.display = 'inline-block';" onmouseout="document.getElementById('textResa').style.display = 'none';">
    <img src="./images/divers/resa.png">
    <span id="textResa" style="display: none; margin-left: 10px; color: white; font-size: 100%;transform: scale(1.20);">Réservation</span>
</a>





          
          <!-- mon nom de profil et photo en petit rond -->
          <a class="profil" href="php/login.php"
    style="
    position: fixed;
    right: 0;
    margin: 10px;
    display: flex;
    text-decoration: none;
    color: white;
    font-weight: bold;
    top: 2%;
    ">
    <img style="
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 2px solid white;
    margin-right: 10px;
    margin-top: -16px;
    "
    src="<?php echo "./php/" . $photoPath; ?>"
    /> 
    <?php echo $prenom; ?>
</a>
         
          <div class="footer_content">
            <div class="footer_section about">
              <p>
                Nous sommes une agence de voyage qui vous propose de découvrir
                les plus beaux pays du monde.
              </p>
              <div class="contact">
                <p><i class="fas fa-phone"></i> &nbsp; 06 22 85 01 96</p>
                <p>
                  <i class="fas fa-envelope"></i> &nbsp;contact@lescinqpays.com
                </p>
              </div>
              
              <div class="socials">
                <a href="#socials"
                  ><img src="./images/divers/fb.png" alt="logo"
                /></a>
                <a href="#socials"
                  ><img src="./images/divers/insta.png" alt="logo"
                /></a>
                <a href="#socials"
                  ><img src="./images/divers/tiktok.png" alt="logo"
                /></a>
              </div>
            </div>
            <div class="place_image">
              <img src="./images/divers/logo.png" alt="logo" />
            </div>
            <div class="footer_section contact_form">
              <h2>Une question ?</h2>
              <form method="post">
                <input
                  type="name"
                  name="name"
                  class="text_input contact_input"
                  placeholder="Votre nom..."
                />
                <input
                  type="email"
                  name="email"
                  class="text_input contact_input"
                  placeholder="Confirmez votre adresse mail..."
                />
                <textarea
                  name="message"
                  class="text_input contact_input"
                  placeholder="Votre message..."
                ></textarea>
                <button type="button" class="btn">Envoyer</button>
              </form>
            </div>
          </div>
          <br>
          <div class="footer_bottom">
            &copy; PROJET WEB | Fait main avec &#x2764; par JART
          </div>
    </div>
  </body>
</html>