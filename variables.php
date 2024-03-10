<?php
$usersStatement = $sql_bdd->prepare('SELECT * FROM users');
$usersStatement->execute();
$users = $usersStatement->fetchAll();

//admin_vote.php
$requete = $sql_bdd->prepare('SELECT activation_vote FROM config');
$requete->execute();
$activation_vote = $requete->fetchAll();
$requete = $sql_bdd->prepare('SELECT limite_vote FROM config');
$requete->execute();
$limite_vote = $requete->fetchAll();
$requete = $sql_bdd->prepare('SELECT nombre_vote FROM config');
$requete->execute();
$nombre_vote = $requete->fetchAll();
$requete = $sql_bdd->prepare('SELECT temps_vote FROM config');
$requete->execute();
$temps_vote = $requete->fetchAll();

$requete = $sql_bdd->prepare('SELECT COUNT(*) FROM concours');
$requete->execute();
$nb_concours = $requete->fetchAll();

//admin_resultats.php
$requete = $sql_bdd->prepare('SELECT affichage_resultats FROM config');
$requete->execute();
$affichage_resultats = $requete->fetchAll();
$requete = $sql_bdd->prepare('SELECT affichage_resultats_admin FROM config');
$requete->execute();
$affichage_resultats_admin = $requete->fetchAll();
