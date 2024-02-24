<?php
$usersStatement = $sql_bdd->prepare('SELECT * FROM users');
$usersStatement->execute();
$users = $usersStatement->fetchAll();