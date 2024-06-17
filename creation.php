<?php
$bdd = new PDO('mysql:host=localhost;dbname=e5_leger', 'root', '');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e5_leger";

$conn = new mysqli($servername, $username, $password, $dbname);

// Formulaire de création de compte
$username = $_POST['pseudo'];
$password = $_POST['mdp'];

// Vérifier si les informations sont valides

if (!empty($username) && !empty($password)) {

    $sql = "SELECT COUNT(*) AS nb_utilisateurs FROM utilisateur WHERE pseudo = '$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row['nb_utilisateurs'] > 0) {
        header('location: inscription.php?erreur3');
    } else {

        $req = $bdd->prepare('INSERT INTO utilisateur (pseudo, mdp) VALUES (:pseudo, :mdp)');
        $req->bindParam(':pseudo', $username);
        $req->bindParam(':mdp', $password);
        $req->execute();

        if ($req->rowCount() > 0) {
            header('Location: index.php?reussite');
        } else {
            header('Location: inscription.php?erreur');
        }
    }
} else {
    header('Location: inscription.php?erreur2');
}
$bdd = null;
