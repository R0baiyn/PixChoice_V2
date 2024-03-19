<?php
session_start();
require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/fonctions.php');

$postData = $_POST;

if (isset($postData['identifiant']) &&  isset($postData['password'])) {
    foreach ($users as $user) {
        if ($user['identifiant'] === $postData['identifiant'] && $user['password'] === crypt($postData['password'], $hash)) {
            $_SESSION['LOGGED_USER'] = [
                'identifiant' => $user['identifiant'],
                'id_user' => $user['id_user'],
                'new_user' => $user['new_user'],
                'superadmin' => $user['superadmin']
            ];
        }
    }

    if (!isset($_SESSION['LOGGED_USER'])) {
        $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Votre identifiant, votre mot de passe ou les deux sont incorrects... Veuillez réessayer.';
        redirectToUrl('index.php?connexion');
    }
    redirectToUrl('admin.php');
}
$_SESSION['LOGIN_ERROR_MESSAGE'] = 'Un problème est survenu lors de la connexion. Veuillez réessayer...';
redirectToUrl('index.php?connexion');
