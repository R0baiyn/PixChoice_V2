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

<style>
    header {
        /* Flex header for better positionning */
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        margin: 0 0 1em 0;
        color: #000;

        /* Necessary for ::before positionning */
        position: relative;
    }

    @media (max-width: 930px) {
        header { flex-flow: column; }
        h1 {text-align: center;}
    }

    header::before {
        content: "";

        position: absolute;
        left: 10%;
        right: 10%;
        bottom: 0;

        height: 1px;
        background-color: #ccc;
    }

    h1 {
        font-family: Roboto Slab, serif;
        font-size: 1.75em;
    }
</style>

<header>
<h1>Les mathématiques sont belles, 3<sup>ème</sup> ed. 2022</h1>
<p>Votes : <?php echo $votes_actuel[0][0]; ?> | Votants : <?php echo $people_actuel[0][0]; ?></p>
</header>