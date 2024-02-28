<?php
function redirectToUrl(string $url): never
{
    header("Location: {$url}");
    exit();
}

function cookie() {
    if (!isset($_COOKIE["NB_VOTE"])){
        $exp = time() + 3600;
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