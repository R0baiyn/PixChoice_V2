<?php
session_start();
require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/fonctions.php');

$postData = $_POST;

if (isset($postData['id_new']) && strlen($postData['id_new']) === 0) {
    $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Votre identifiant ne peut pas être vide.';
    redirectToUrl('admin.php?Parametres');
} elseif (isset($postData['password_new']) && strlen($postData['password_new']) < 8) {
    $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Votre nouveau mot de passe doit au moins contenir 8 caractères.';
    redirectToUrl('admin.php?Parametres');
}

if (isset($postData['id_new']) && isset($postData['id_actuel']) && isset($postData['password_actuel'])) {
    
    foreach ($users as $user) {
        if ($postData['id_actuel'] === $user['identifiant'] && crypt($postData['password_actuel'], $hash) === $user['password']){
            
            $requete = $sql_bdd->prepare("UPDATE users SET identifiant = '".$postData['id_new']."' WHERE identifiant = '".$user['identifiant']."' AND password = '".$user['password']."'");
            $requete->execute();
            unset($_SESSION['LOGGED_USER']);
            $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Vous devez vous reconnecter suite à la demande de changement d\'identifiant';
            redirectToUrl('index.php?connexion');
        }
    }

} elseif (isset($postData['id_actuel']) && isset($postData['password_actuel']) && isset($postData['password_new'])){

    foreach ($users as $user) {
        if ($postData['id_actuel'] === $user['identifiant'] && crypt($postData['password_actuel'], $hash) === $user['password']){

            $requete = $sql_bdd->prepare("UPDATE users SET password = '".crypt($postData['password_new'], $hash)."' WHERE identifiant = '".$user['identifiant']."' AND password = '".$user['password']."'");
            $requete->execute();
            if ($user['new_user']){
                $requete = $sql_bdd->prepare("UPDATE users SET new_user = 0 WHERE identifiant = '".$user['identifiant']."' AND password = '".crypt($postData['password_new'], $hash)."'");
                $requete->execute();
            }
            unset($_SESSION['LOGGED_USER']);
            $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Vous devez vous reconnecter suite à la demande de changement de mot de passe';
            redirectToUrl('index.php?connexion');
        }
    }   
}

$_SESSION['LOGIN_ERROR_MESSAGE'] = 'Votre identifiant, votre mot de passe ou les deux sont incorrects... Veuillez réessayer.';
redirectToUrl('admin.php?Parametres');
