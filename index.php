<?php
session_start();
require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/fonctions.php');
cookie($temps_vote[0][0]);
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixchoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php
$postData = $_POST;
$getData = $_GET;

include('header.php'); 

if (isset($postData['connexion']) || isset($_GET['connexion'])) {
    include('login.php');
} else {
    include('vote.php');
};?>
</body>
</html>