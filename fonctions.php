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