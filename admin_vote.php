<?php
require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/fonctions.php');
require_once(__DIR__ . '/variables.php');
if (!isadmin()){
    $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Vous ne pouvez pas accéder à cette page sans être connecté.';
    redirectToUrl('index.php?connexion');
}
if (!empty($postData)){
    if (isset($postData["activation_vote"])){
        $requete = $sql_bdd->prepare('UPDATE config SET activation_vote = 1');
        $requete->execute();
    } else {
        $requete = $sql_bdd->prepare('UPDATE config SET activation_vote = 0');
        $requete->execute();
    };

    if (isset($postData["limite_vote"])){
        $requete = $sql_bdd->prepare('UPDATE config SET limite_vote = 1');
        $requete->execute();
    } else {
        $requete = $sql_bdd->prepare('UPDATE config SET limite_vote = 0');
        $requete->execute();
    };

    if ($postData['nombre_vote'] !== $nombre_vote[0][0]){
        $requete = $sql_bdd->prepare("UPDATE config SET nombre_vote = '" . $postData['nombre_vote'] . "'");
        $requete->execute();
    }

    if ($postData['temps_vote'] !== $temps_vote[0][0]){
        $requete = $sql_bdd->prepare("UPDATE config SET temps_vote = '" . $postData['temps_vote'] . "'");
        $requete->execute();
    }

    if ($postData['header_titre'] !== $header_titre[0][0]){
        $requete = $sql_bdd->prepare("UPDATE config SET header_titre = '" . strip_tags($postData['header_titre'], ['<br>', '<a>', '</a>', '<strong>', '</strong>']) . "'");
        $requete->execute();
    }

    if ($postData['header_texte'] !== $header_texte[0][0]){
        $requete = $sql_bdd->prepare("UPDATE config SET header_texte = '" . strip_tags($postData['header_texte'], ['<br>', '<a>', '</a>', '<strong>', '</strong>']) . "'");
        $requete->execute();
    }

}
include(__DIR__ . '/variables.php');
?>
<div id="main">
    <div class="header">
        <h1>Configuration du vote</h1>
    </div>
    <div class="content">
            <h2 class="content-subhead">Cette page permet de configurer le vote, vous pouvez activer ou non la possibilité de voter, le nombre de vote sur une certaine durée, et la durée en question.</h2>
            <form method="post" action="admin.php?Vote" class="pure-form">
            <h2 class="content-subhead">Activation / Désactivation du vote.</h2>
            <div style="margin-top: 15px;">
                <label class="switch">
                    <input type="checkbox" name="activation_vote" <?php if ($activation_vote[0][0]){echo 'checked';} ?>>
                    <span class="slider round"></span>
                </label>
            </div>
            <p><?php if ($activation_vote[0][0]){echo"Le vote est actuellement activé";} else {echo"Le vote est actuellement désactivé";} ?></p>
            
            <h2 class="content-subhead">Activation / Désactivation du vote pour les admins malgré la limite.</h2>
            <div style="margin-top: 15px;">
                <label class="switch">
                    <input type="checkbox" name="limite_vote" <?php if ($limite_vote[0][0]){echo 'checked';} ?>>
                    <span class="slider round"></span>
                </label>
            </div>
            <p><?php if ($limite_vote[0][0]){echo"Les admins peuvent voter sans limites";} else {echo"Les admins ne peuvent pas voter sans limites";} ?></p>

            <h2 class="content-subhead">Nombre d'actualisations possibles sur un temps donné</h2>
            <div class="pure-control-group">
                <input type="number" id="aligned-name" name="nombre_vote" value="<?php echo $nombre_vote[0][0]; ?>"/>
                <label for="aligned-name">Actualisations avant d'être bloqué</label>
            </div>
            <h2 class="content-subhead">Temps avant de pouvoir revoter</h2>
            <div class="pure-control-group">
                <input type="number" id="aligned-name" name="temps_vote" value="<?php echo $temps_vote[0][0]; ?>"/>
                <label for="aligned-name">Secondes entre chaque vote</label>
            </div>

            <h2 class="content-subhead">Titre de l'en-tête</h2>
            <div class="pure-control-group">
                <textarea style="width: 80%; height: 100px; margin-bottom: 20px" type="text" id="aligned-name" name="header_titre"><?php echo $header_titre[0][0]; ?></textarea>
                <br><label for="aligned-name">Permet de changer le titre de l'en-tête du site</label>
            </div>

            <h2 class="content-subhead">Texte de l'en-tête</h2>
            <div class="pure-control-group">
                <textarea style="width: 80%; height: 100px; margin-bottom: 20px" type="text" id="aligned-name" name="header_texte"><?php echo $header_texte[0][0]; ?></textarea>
                <br><label for="aligned-name">Permet de changer le texte de l'en-tête du site</label>
            </div>


            <h2 class="content-subhead">Appliquer les changements</h2>
            <p>
                <div class="pure-controls">
                    <button type="submit" class="pure-button pure-button-primary">Appliquer les changements</button>
                </div>
            </p>
            </form>
        </div>
</div>
