<?php
require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/fonctions.php');

$uploads_dir = __DIR__.'/images';
foreach ($_FILES["screenshot"]["error"] as $key => $error) {
    $requete = $sql_bdd->prepare('SELECT COUNT(*) FROM concours');
    $requete->execute();
    $nb_concours = $requete->fetchAll();

    $requete = $sql_bdd->prepare('SELECT * FROM concours ORDER BY id');
    $requete->execute();
    $resultats = $requete->fetchAll();

    $id_image = 1;
    if ($nb_concours[0][0]){
        echo "condition<br>";
        foreach ($resultats as $inutile) {
            if ($id_image !== $resultats[$id_image-1]['id']){
                break;
            }
            $id_image += 1;
        }
    }

    if (strlen($id_image)===1) {
        $nom_image = "00".$id_image.".png";
    } elseif (strlen($id_image)===2) {
        $nom_image = "0".$id_image.".png";
    } else {
        $nom_image = $id_image.".png";
    }
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["screenshot"]["tmp_name"][$key];
        $name = basename($_FILES["screenshot"]["name"][$key]);
        move_uploaded_file($tmp_name, "$uploads_dir/$nom_image");

        $requete = $sql_bdd->prepare("INSERT INTO concours VALUES ('". $nom_image ."', ". $id_image .", 0, 0)");
        $requete->execute();
    }
}

redirectToUrl("admin.php?Images");?>