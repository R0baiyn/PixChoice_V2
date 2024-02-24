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
<h1>Pixchoice : Les mathématiques sont belles, 3<sup>ème</sup> ed. 2022</h1>
<?php if (isset($_SESSION['LOGGED_USER'])) : ?>
    <form method="post" action="logout.php">
        <button type='submit'class="pure-button pure-button-primary">Se déconnecter</button>
    </form>
<?php endif ;?>
<p>Votes : <?php echo $votes_actuel[0][0]; ?> | Votants : <?php echo $people_actuel[0][0]; ?></p>
</header>