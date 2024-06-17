<?php
session_start();

// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=e5_leger', 'root', '');

// Récupération des informations du formulaire
$pseudo = $_POST['pseudo'];
$mdp = $_POST['mdp'];

// Requête pour vérifier si le compte et le mot de passe sont correspondants
$req = $bdd->prepare('SELECT * FROM utilisateur WHERE pseudo = :pseudo AND mdp = :mdp');
$req->bindParam(':pseudo', $pseudo);
$req->bindParam(':mdp', $mdp);
$req->execute();

// Vérification si un résultat est trouvé
if ($req->rowCount() > 0) {
    // Le compte et le mot de passe sont correspondants
    $_SESSION['username'] = $pseudo;
    $_SESSION['logged_in'] = true;
    header('Location: jeu.html');
    // Vous pouvez ici déclencher une action, comme la connexion de l'utilisateur
} else {
    // Le compte et le mot de passe ne sont pas correspondants
    header('Location: index.php?erreur');
}

// Fermeture de la connexion à la base de données
$bdd = null;
