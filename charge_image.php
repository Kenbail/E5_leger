<?php
session_start();
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=e5_leger', 'root', '');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e5_leger";
$conn = new mysqli($servername, $username, $password, $dbname);
$id_banque = $_SESSION['id_banque'][0];
// Récupération des données des images
$images = array(); // tableau pour stocker les données des images

// requête SQL pour récupérer les données des images
$query = "SELECT Image FROM banque_image where id_banque = $id_banque";
$result = mysqli_query($conn, $query);

$i = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $images[$i] = $row['Image']; // stocker les IDs des images dans le tableau
    $i += 1;
}

echo json_encode($images);
