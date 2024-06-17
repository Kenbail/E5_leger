<?php
session_start();
unset($_SESSION['images']);
unset($_SESSION['id_banque']);
$bdd = new PDO('mysql:host=localhost;dbname=e5_leger', 'root', '');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e5_leger";

$conn = new mysqli($servername, $username, $password, $dbname);
$images = array(); // tableau pour stocker les données des images

// requête SQL pour récupérer les données des images
$query = "SELECT id, Image,id_banque FROM banque_image";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $images[] = $row['id']; // stocker les IDs des images dans le tableau
    $id_banque[] = $row['id_banque'];
}

// store the image IDs in the session variable
$_SESSION['images'] = $images;
$_SESSION['id_banque'] = $id_banque;


header('Location: customisation.php');
