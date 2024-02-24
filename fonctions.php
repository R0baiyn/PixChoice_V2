<?php
function redirectToUrl(string $url): never
{
    header("Location: {$url}");
    exit();
}