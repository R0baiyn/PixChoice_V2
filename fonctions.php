<?php
function redirectToUrl(string $url): never
{
    header("Location: {$url}");
    exit();
}

function logout()
{
    session_destroy();
    redirectToUrl('index.php');
}