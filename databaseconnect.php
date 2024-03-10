<?php
try {
    $sql_bdd = new PDO(
        sprintf('mysql:host=%s;dbname=%s;charset=utf8', $sql_host, $sql_dbname),
        $sql_id,
        $sql_password
    );
    $sql_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $exception) {
    die('Connexion impossible...');
}
