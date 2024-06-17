<!DOCTYPE html>
<html lang="fr">
<?php

unset($_SESSION["pseudo"])
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <div class="center">
        <form action="connection.php" method="post">
            <div>
                Pseudo:
                <input name="pseudo">
            </div>
            <div>
                Mot de passe:
                <input name="mdp">
            </div>
            <input class="boutton" value="se connecter" type="submit">
        </form>

    </div>
    <div class="center">
        <div>
            <a class="boutton" id="inscription" href="inscription.php">S'inscrire</a>
        </div>
    </div>



    <?php
    if (isset($_GET['erreur'])) {
        echo "<script>
        alert('Vérifier vos informations.');
    </script>";
    }
    if (isset($_GET['reussite'])) {
        echo "<script>
        alert('Compte Créer avec succès.');
    </script>";
    }

    ?>
</body>

</html>