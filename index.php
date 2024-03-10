<?php
session_start(); // Création d'une session pour sauvegardé des données
// Appel de différentes pages pour instancier :
require_once(__DIR__ . '/config.php'); // Les identifiants de la base de donnée
require_once(__DIR__ . '/databaseconnect.php'); // Une connexion à la base de donnée
require_once(__DIR__ . '/variables.php'); // Des variables récupérées en sql
require_once(__DIR__ . '/fonctions.php'); // Des fonctions
cookie($temps_vote[0][0]); // Appel de la fonction cookie qui va créer un cookie 
//pour contenir le nombre de vote fait
?>

<!doctype html> <!-- Code html basique -->
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixchoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php // retour en php pour récupérer les variables envoyés en post ou en get
$postData = $_POST;
$getData = $_GET;

include('header.php'); // Ajout de l'en tête de page

// ajout de la page de connexion si des variables existent
if (isset($postData['connexion']) || isset($_GET['connexion'])) { 
    include('login.php');
} else {
    include('vote.php'); // et si elles n'existent pas ajout de la page de vote
};?>
</body> <!-- Fin du code html -->
</html>