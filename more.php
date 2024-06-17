<?php
$bdd = new PDO('mysql:host=localhost;dbname=e5_leger', 'root', '');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e5_leger";

$conn = new mysqli($servername, $username, $password, $dbname);

$id_banque = $_GET['id'];
$sql = "SELECT Image, nom_banque, Createur,id_banque  FROM banque_image where id_banque = " . $id_banque . " ";
$result = $conn->query($sql);

?>
<html>

<head>
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <a href='customisation.php' class="boutton">retourner aux choix</a>
    <div class="centercol">

        <?php
        if ($result->num_rows > 0) {
            $i = 0;
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $image = $row["Image"];
                $creat = $row["Createur"];
                $nom = $row["nom_banque"];
                $id_banque = $row["id_banque"];
                $params = array('id' => $id_banque);
                $queryString = http_build_query($params);
                echo '<div>
                        <div class="modal">
                            <h2>' . $nom . '</h2>
                            <p>Créateur: ' . $creat . '</p>
                            <img src="data:image/jpeg;base64,' . $image . '" alt="Image">
                        </div>
                    </div>';
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>