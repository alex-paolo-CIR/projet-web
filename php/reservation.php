<?php
include '../php/paramCompte.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    function generateRandomId($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
  
    $id_reservation = generateRandomId();
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $pays = $_POST['pays'];
    $date_depart = $_POST['date'];
    $duree = $_POST['duree'];
    $nb_voyageurs = $_POST['nbVoyageurs'];
    $nb_bagages = $_POST['nbBagages'];

    $tarif_par_personne = 100;
    $tarif_par_bagage = 20;
    $montant_total = ($tarif_par_personne * $nb_voyageurs) + ($tarif_par_bagage * $nb_bagages);

    $sql = "INSERT INTO reservations (nom, prenom, email, pays, date_depart, duree, nb_voyageurs, nb_bagages, id_reservation, montant_total) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssd", $nom, $prenom, $email, $pays, $date_depart, $duree, $nb_voyageurs, $nb_bagages, $id_reservation, $montant_total);

    if ($stmt->execute()) {
        echo "<div style='position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.7); color: white; font-size: 30px; text-align: center; padding-top: 20%; z-index: 999;'>
                Réservation créée ! Bon voyage !
            </div>";
        header("refresh:2;url=../index.php");
    } else {
        echo "Erreur lors de la réservation: " . $conn->error;
    }

    $stmt->close();
}

if(isset($_COOKIE['reservation'])) {
    $reservation_data = json_decode($_COOKIE['reservation'], true);
    setcookie('reservation', '', time() - 3600, "/");
} else {
    $reservation_data = array(
        'nom' => '',
        'prenom' => '',
        'email' => '',
        'pays' => '',
        'date_depart' => '',
        'duree' => '',
        'nb_voyageurs' => '',
        'nb_bagages' => ''
    );
}

$nom = $reservation_data['nom'];
$prenom = $reservation_data['prenom'];
$email = $reservation_data['email'];
$pays = $reservation_data['pays'];
$date_depart = $reservation_data['date_depart'];
$duree = $reservation_data['duree'];
$nb_voyageurs = $reservation_data['nb_voyageurs'];
$nb_bagages = $reservation_data['nb_bagages'];

include 'paramCompte.php';
include 'fonctionConnexion.php';

$nom = $prenom = $email = "";

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_id = $_SESSION['id'];

$sql = "SELECT * FROM compteclient WHERE ID='$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nom = $row['Nom'];
        $prenom = $row['Prenom'];
        $email = $row['email'];
    }
} else {
  $nom = '';
  $prenom = '';
  $email = '';
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
    <title>Réservation</title>
    <style>
        #resaform {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
        }
        
        input[type="text"],
        input[type="email"],
        select {
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }
        
        input[type="date"],
        input[type="number"],
        select {
            width: 50%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
    </style>
</head>
<body id="Resa">
    <div style="position: relative; z-index: 2">
        <main id="ResaMain" style="margin-right:60px; margin-left: 60px; padding: 20px; border-radius: 5px; background-color: rgba(0, 0, 0, 0.562); border: 2px solid white;">
            <h1 id="resah1" style="display: flex; align-items: center; text-align: center; justify-content: center; text-decoration: underline;">
                Réservation de votre voyage
            </h1>
            
            <form id="resaform" method="post">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" value="<?php echo $nom; ?>" readonly />

                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="<?php echo $prenom; ?>" readonly />

                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo $email; ?>" readonly />

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

                <label for="duree">Durée du séjour</label>
                <input type="number" name="duree" id="duree" min="1" required />

                <br />

                <label for="nbVoyageurs">Nombre de voyageurs</label>
                <input type="number" name="nbVoyageurs" id="nbVoyageurs" min="1" required />

                <br />

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

            <a class="menu" style="transform: scale(0.8); left: 8px;"><img src="../images/divers/globee.png" /></a>

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
