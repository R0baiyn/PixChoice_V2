<?php
session_start();
require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/fonctions.php');
require_once(__DIR__ . '/variables.php');
if (!isadmin()){
    $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Vous ne pouvez pas accéder à cette page sans être connecté.';
    redirectToUrl('index.php?connexion');
}

$postData = $_POST;
$getData = $_GET;

if (!empty($postData)){
    foreach ($postData as $image) {
        $requete = $sql_bdd->prepare("UPDATE concours SET nb_votes = 0 WHERE image = '" . $image . "'; UPDATE concours SET nb_fois = 0 WHERE image = '" . $image . "'");
        $requete->execute();
    }
}
if (isset($getData['all'])){
    $requete = $sql_bdd->prepare("UPDATE concours SET nb_votes = 0; UPDATE concours SET nb_fois = 0");
    $requete->execute();
}
redirectToUrl('admin.php?Images');