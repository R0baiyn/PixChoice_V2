<?php
session_start();
require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/fonctions.php');

$postData = $_POST;

// Validation du formulaire
if (isset($postData['identifiant']) &&  isset($postData['password'])) {
    foreach ($users as $user) {
        if (
            $user['identifiant'] === $postData['identifiant'] &&
            $user['password'] === crypt($postData['password'], $hash)
        ) {
            $_SESSION['LOGGED_USER'] = [
                'identifiant' => $user['identifiant'],
                'user_id' => $user['user_id'],
            ];
        }
    }

    if (!isset($_SESSION['LOGGED_USER'])) {
        $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Les informations données ne correspondent pas à un utilisateur';
    }
    redirectToUrl('index.php');
}
$_SESSION['LOGIN_ERROR_MESSAGE'] = 'Un problème est survenu lors de la connexion. Veuillez réessayer...';
redirectToUrl('index.php');