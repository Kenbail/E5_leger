<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=e5_leger', 'root', '');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e5_leger";

$conn = new mysqli($servername, $username, $password, $dbname);


$sql = "SELECT Image, nom_banque, Createur,id_banque  FROM banque_image GROUP BY id_banque";
$result = $conn->query($sql);



?>
<html>

<head>
    <link href="style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <a href='jeu.html' class="boutton">retourner au jeu</a>
    <?php
    if (isset($_SESSION['images'])) {
        $images = $_SESSION['images'];
        $id_banque = $_SESSION['id_banque'][0];
        $query2 = "SELECT nom_banque FROM banque_image WHERE id_banque = $id_banque GROUP BY nom_banque";
        $result2 = mysqli_query($conn, $query2);

        $nom_banques = array(); // create an empty array to store the results

        while ($row = mysqli_fetch_assoc($result2)) {
            $nom_banques[] = $row['nom_banque']; // store each value in the array
        }

        // now you can use the $nom_banques array
        print_r("Banque d'image choisi: " . $nom_banques[0]); // or use json_encode($nom_banques) to output as JSON
    } else {
        echo "No images stored in session.";
    }

    ?>
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
                            <a href="more.php?' . $queryString . '" class="boutton">voir toute les images</a>
                            <a href="get_images.php?' . $queryString . '" class="boutton">Choisir ces images</a>
                        </div>
                    </div>';
            }
        } else {
            echo "0 results";
        }

        ?>
    </div>

    <script src="imageinsession.js"></script>
</body>

</html>