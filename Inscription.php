<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <a href='index.php' class="boutton">Se connecter</a>
    <div class="center">
        <form action="creation.php" method="post">
            <div>
                Speudo:
                <input name="pseudo">
            </div>
            <div>
                Mot de passe:
                <input name="mdp">
            </div>
            <input class="boutton" value="s'inscire" type="submit">
        </form>

    </div>
    <?php
    if (isset($_GET['erreur'])) {
        echo "<script>
        alert('Nom invalide.');
    </script>";
    }

    if (isset($_GET['erreur2'])) {
        echo "<script>
        alert('Veuillez remplir toute les champs.');
    </script>";
    }

    if (isset($_GET['erreur3'])) {
        echo "<script>
        alert('Le pseudo est déjà utilisé, veuillez en choisir un autre.');
    </script>";
    }


    ?>
</body>

</html>