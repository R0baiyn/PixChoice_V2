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
<h1>Pixchoice : Les mathématiques sont belles, 3<sup>ème</sup> ed. 2022.</h1>

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
    <p>Les élèves de en classe de seconde 5 et 7 du lycée Louis Pasteur d'Avignon ont produit 55 images uniques sur leur calculatrice NumWorks.</p>
    <p>Vous pouvez : <b>voter pour vos images favorites,</b> ou <a href="https://twitter.com/nsi_xyz/status/1507684348820082690">découvrir une sélection de 42 images</a></p> 
    <p>6 images vous sont présentées aléatoirement, vous en choisissez une et d'autres vous seront présentées.</p>
</article>
<?php endif; ?>
