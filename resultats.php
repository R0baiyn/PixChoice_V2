<?php
session_start();
require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/fonctions.php');
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixchoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php

if (!($affichage_resultats[0][0] || (isset($_SESSION['LOGGED_USER']) && $affichage_resultats_admin[0][0]))){
$_SESSION['LOGIN_ERROR_MESSAGE'] = 'Les résultats ne sont pas disponibles pour le moment';
redirectToUrl('index.php?connexion');
}

$votes = "SELECT SUM(nb_votes) as result FROM concours";
$requete = $sql_bdd -> prepare($votes);
$requete -> execute();
$votes_actuel = $requete -> fetchAll();

$people = "SELECT COUNT(ip) FROM votant";
$requete = $sql_bdd -> prepare($people);
$requete -> execute();
$people_actuel = $requete -> fetchAll();

$votes="SELECT SUM(nb_votes) as result FROM concours";
$requete = $sql_bdd->prepare($votes);
$requete->execute();
$votes_actuel = $requete->fetchAll();

$gagnant="select * from concours";
$requete = $sql_bdd->prepare($gagnant);
$requete->execute();
$sortie = $requete->fetchAll();

$maximum=0;
$gagnant=0;
$taux_max=0;
$prefere=0;
for ($i = 1; $i < count($sortie); $i++) {
    if ($sortie[$i]["nb_votes"]>$maximum){
		$maximum=$sortie[$i]["nb_votes"];
		$gagnant=$i;
	}
	if ($sortie[$i]["nb_fois"]!=0){
		if ($sortie[$i]["nb_votes"]/$sortie[$i]["nb_fois"]>$taux_max){
			$taux_max=$sortie[$i]["nb_votes"]/$sortie[$i]["nb_fois"];
			$prefere=$i;
		}
	}
}



?>
<div class="page">
<header>
<h1><?php echo $header_titre[0][0]; ?></h1>
<a class="pure-button pure-button-primary" href="index.php" style="margin: 1em; text-align: center; background: rgb(28, 184, 65);">Retourner au vote</a>

<?php
if (!isset($_SESSION['LOGGED_USER']) && !isset($postData['connexion']) && !isset($getData['connexion'])) : ?>
    <form method="post" action="index.php">
        <button type='submit'class="pure-button pure-button-primary" name='connexion' style="margin: 1em;">Se connecter</button>
    </form>

<?php elseif(isset($_SESSION['LOGGED_USER'])) :?>
    <form method="post" action="admin.php">
        <button type='submit'class="pure-button pure-button-primary" name="panel admin" style="margin: 1em;">Panel Admin</button>
    </form>
    <form method="post" action="logout.php">
        <button type='submit'class="pure-button pure-button-primary" style="margin: 1em;">Se déconnecter</button>
    </form>
<?php endif;?>

<p>Votes : <?php echo $votes_actuel[0][0]; ?> | Votants : <?php echo $people_actuel[0][0]; ?></p>
</header>
<h1>Résultats :</h1>
<?php if ($nb_concours[0][0] < 6){
    echo '<div class="alert alert-danger" role="alert">Il n\'y a pas assez d\'image disponible</div>';
    exit();
};?>
Le concours a reçu <?php echo $votes_actuel[0][0];?> votes.<br>
<p>L'image ayant reçu le plus de votes est : <?php echo $sortie[$gagnant]["image"].", avec ".$sortie[$gagnant]["nb_votes"]." votes."; ?></p>
<img class='pure-img-responsive image' src='images/<?php echo $sortie[$gagnant]["image"]?>'>	
<br><br>
<p>L'image ayant le plus fort taux de victoires : <?php echo $sortie[$prefere]["image"].", avec ".round($taux_max*100)."% de victoires par présentation."; ?></p>
<img class='pure-img-responsive image' src='images/<?php echo $sortie[$prefere]["image"]?>'>

<h1>Résultats en détails:</h1>
<?php
$gagnant="select * from concours ORDER BY nb_votes";
$requete = $sql_bdd->prepare($gagnant);
$requete->execute();
$sortie = $requete->fetchAll();
$sortie=array_reverse($sortie);
echo "<ol>";
foreach($sortie as $enr){
	echo "<li>".$enr["image"]." avec ".$enr["nb_votes"]."votes<br><br><img class='pure-img-responsive image' src='images/".$enr["image"]."'></li><br>";
}
echo "</ol>";
