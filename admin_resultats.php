<?php
include(__DIR__ . '/variables.php');
if (!empty($postData)){
    if (isset($postData["affichage_resultats"])){
        $requete = $sql_bdd->prepare('UPDATE config SET affichage_resultats = 1');
        $requete->execute();
    } else {
        $requete = $sql_bdd->prepare('UPDATE config SET affichage_resultats = 0');
        $requete->execute();
    };

    if (isset($postData["affichage_resultats_admin"])){
        $requete = $sql_bdd->prepare('UPDATE config SET affichage_resultats_admin = 1');
        $requete->execute();
    } else {
        $requete = $sql_bdd->prepare('UPDATE config SET affichage_resultats_admin = 0');
        $requete->execute();
    };
}
include(__DIR__ . '/variables.php');
?>

<div id="main">
    <div class="header">
        <h1>Configuration des résultats</h1>
    </div>
    <div class="content">
            <h2 class="content-subhead">Cette page permet de configurer les résultats</h2>
            <form method="post" action="admin.php?Resultats" class="pure-form">
            <h2 class="content-subhead">Activation / Désactivation des résultats pour tous.</h2>
            <div style="margin-top: 15px;">
                <label class="switch">
                    <input type="checkbox" name="affichage_resultats" <?php if ($affichage_resultats[0][0]){echo 'checked';} ?>>
                    <span class="slider round"></span>
                </label>
            </div>
            <p><?php if ($affichage_resultats[0][0]){echo"L'affichage des résultats est actuellement activé";} else {echo"L'affichage des résultats est actuellement désactivé";} ?></p>
            
            <h2 class="content-subhead">Activation / Désactivation de l'affichage des résultats pour les admins.</h2>
            <div style="margin-top: 15px;">
                <label class="switch">
                    <input type="checkbox" name="affichage_resultats_admin" <?php if ($affichage_resultats_admin[0][0]){echo 'checked';} ?>>
                    <span class="slider round"></span>
                </label>
            </div>
            <p><?php if ($affichage_resultats_admin[0][0]){echo"Les admins peuvent voir les résultats";} else {echo"Les admins ne peuvent pas voir les résultats";} ?></p>

            <h2 class="content-subhead">Appliquer les changements</h2>
            <p>
                <div class="pure-controls">
                    <button type="submit" class="pure-button pure-button-primary">Appliquer les changements</button>
                </div>
            </p>
            </form>
        </div>
</div>
