<?php
function redirectToUrl(string $url): never
{
    header("Location: {$url}");
    exit();
}

function cookie() {
    if (!isset($_COOKIE["NB_VOTE"])){
        $exp = time() + 3600;
        setcookie('cookie_exp', $exp, ['expires' => $exp, 'secure' => true, 'httponly' => true,]);
        setcookie(
            'NB_VOTE',
            '0',
            [
                'expires' => $exp,
                'secure' => true,
                'httponly' => true,
            ]
        );
    }
}