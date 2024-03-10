<?php
session_start();
require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/fonctions.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New user</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
</head>
<body>

<?php

$postData = $_POST;

if (isset($_SESSION['LOGGED_USER']) && !$_SESSION['LOGGED_USER']["superadmin"]){
    redirectToUrl('admin.php?Utilisateurs');
}




if (isset($postData['newuser_id'])){

    $newuser_id = $postData['newuser_id'];
    $newuser_password = passwordgen(16);
    $requete = $sql_bdd->prepare("INSERT INTO users VALUES (null, '".$newuser_id."', '".crypt($newuser_password, $hash)."', 1, 0)");
    $requete->execute();
    echo "<p style='margin: 1em;'>id: " .$newuser_id. "<br>mdp: ".$newuser_password."</p>";
    echo '<br><a class="pure-button pure-button-primary" href="admin.php?Utilisateurs" style="margin: 1em;">Retour</a>';

} elseif (isset($postData['toggle_superadmin'])){

    $requete = $sql_bdd->prepare("SELECT superadmin FROM users where id_user = '".$postData['toggle_superadmin']."'");
    $requete->execute();
    $admin = $requete->fetchAll();

    if ($admin[0][0]){
        $requete = $sql_bdd->prepare("UPDATE users SET superadmin = 0 WHERE id_user='".$postData['toggle_superadmin']."'");
    } else {
        $requete = $sql_bdd->prepare("UPDATE users SET superadmin = 1 WHERE id_user='".$postData['toggle_superadmin']."'");
    }
    $requete->execute();
    redirectToUrl("admin.php?Utilisateurs");

} elseif (isset($postData['remove_user'])) {

    $requete = $sql_bdd->prepare("DELETE FROM users WHERE id_user = '".$postData['remove_user']."'");
    $requete->execute();
    redirectToUrl("admin.php?Utilisateurs");
}
