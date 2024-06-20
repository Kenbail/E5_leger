<?php
session_start();
// Connexion à la base de données
$host = 'localhost';
$db   = 'E5_leger';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e5_leger";
$conn = new mysqli($servername, $username, $password, $dbname);


$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

// variable
$createur = $_SESSION["username"];
$nom_banque = $_POST['nom_banque'];
$file = $_FILES['image'];
$filename = $file['name'];
$filetmp = $file['tmp_name'];
$filesize = $file['size'];
$fileerror = $file['error'];

// Lecture du fichier en mémoire
$filecontent = file_get_contents($filetmp);




$sql = "SELECT COUNT(*) AS nb_banque FROM banque_image WHERE nom_banque = '$nom_banque'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row['nb_banque'] > 0) {
    $sql2 = "SELECT id_banque FROM banque_image WHERE nom_banque = '$nom_banque'";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    $id_banque = $row2['id_banque'];
} else {
    $sql2 = "SELECT Max(id_banque) as id_b FROM banque_image";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    $id_banque = $row2['id_b'];
    $id_banque += 1;
}




// Préparation de la requête SQL
$stmt = $pdo->prepare("INSERT INTO banque_image (id_banque, Createur, nom_banque, Image) VALUES (?,?,?,?)");
$stmt->execute([$id_banque, $createur, $nom_banque, base64_encode($filecontent)]);


header('Location: creation_banque.php');
