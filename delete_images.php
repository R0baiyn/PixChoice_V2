<?php
require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/fonctions.php');

$postData = $_POST;
$getData = $_GET;

if (!empty($postData)){
    foreach ($postData as $image) {
        $requete = $sql_bdd->prepare("DELETE FROM concours WHERE image = '" . $image . "'");
        $requete->execute();
        if (file_exists('images/'.$image)) {
            unlink('images/'.$image);
        }
    }
}
if (isset($getData['all'])){

    $requete = $sql_bdd->prepare("SELECT * FROM concours");
    $requete->execute();
    $images = $requete->fetchAll();

    foreach ($images as $image) {
        $requete = $sql_bdd->prepare("DELETE FROM concours WHERE image = '" . $image['image'] . "'");
        $requete->execute();
        if (file_exists('images/'.$image['image'])) {
            unlink('images/'.$image['image']);
        }
    }
}
redirectToUrl('admin.php?Images');
