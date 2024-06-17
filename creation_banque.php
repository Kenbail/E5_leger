<!-- index.html -->
<!DOCTYPE html>
<html>

<head>
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <a href='jeu.html' class="boutton">retourner au jeu</a>
    <div class="centercol">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            nom:<input type="text" name="nom_banque">
            <input type="file" name="image">
            <input type="submit">
        </form>
    </div>
</body>

</html>