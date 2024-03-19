<?php


$votes = "SELECT SUM(nb_votes) as result FROM concours";
$requete = $sql_bdd -> prepare($votes);
$requete -> execute();
$votes_actuel = $requete -> fetchAll();

$people = "SELECT COUNT(ip) FROM votant";
$requete = $sql_bdd -> prepare($people);
$requete -> execute();
$people_actuel = $requete -> fetchAll();
?>

<header>
<h1><?php echo $header_titre[0][0]; ?></h1>

<?php 
    if ($affichage_resultats[0][0] || (isset($_SESSION['LOGGED_USER']) && $affichage_resultats_admin[0][0])): ?>
        <a class="pure-button pure-button-primary" href="resultats.php" style="margin: 1em; text-align: center; background: rgb(28, 184, 65);">Voir les résultats</a>
    <?php endif;

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

<?php else :?>
    <form method="post" action="index.php">
        <button type='submit'class="pure-button pure-button-primary" style="margin: 1em;">Voter sans se connecter</button>
    </form>

<?php endif; ?>
<p>Votes : <?php echo $votes_actuel[0][0]; ?> | Votants : <?php echo $people_actuel[0][0]; ?></p>
</header>

<?php if (!isset($postData['connexion']) && !isset($_GET['connexion'])) :?>
<article>
    <p><?php echo $header_texte[0][0]; ?></p>
</article>
<?php endif; ?>
