<?php

function redirectToUrl(string $url): never
{
    header("Location: {$url}");
    exit();
}

function cookie($temps) {
    if (!isset($_COOKIE["NB_VOTE"])){
        $exp = time() + $temps;
        setcookie('cookie_exp', $exp, [
            'expires' => $exp,
            'secure' => true,
            'httponly' => true,
        ]);
        setcookie('NB_VOTE', '1', [
            'expires' => $exp,
            'secure' => true,
            'httponly' => true,
        ]);
    } elseif (isset($_COOKIE["NB_VOTE"])) {
        setcookie('NB_VOTE', $_COOKIE["NB_VOTE"]+1, [
            'expires' => $_COOKIE["cookie_exp"],
            'secure' => true,
            'httponly' => true,
        ]);
    }
}

function passwordgen($longueur=8) {
    $Chaine = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ@+-*/";
    $Chaine = str_shuffle($Chaine);
    $Chaine = substr($Chaine,0,$longueur);
    return $Chaine;
   }
   
function isadmin(){
    include(__DIR__ . '/config.php');
    include(__DIR__ . '/databaseconnect.php');
    include(__DIR__ . '/variables.php');
    verif_session();
    foreach($users as $user) {
        if ($user['id_user'] === $_SESSION['LOGGED_USER']['id_user']) {
            return true;
        }
    }
    return false;
}

function issuperadmin(){
    include(__DIR__ . '/config.php');
    include(__DIR__ . '/databaseconnect.php');
    include(__DIR__ . '/variables.php');
    verif_session();
    $requete = $sql_bdd -> prepare("SELECT * FROM users WHERE id_user = '". $_SESSION['LOGGED_USER']['id_user']."'");
    $requete -> execute();
    $votant = $requete -> fetchAll();
    print_r($votant);
    if ($votant[0]['superadmin']) {
        return true;
    } else {
        return false;
    }
}

function verif_session(){
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
}

