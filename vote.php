<?php
if ($activation_vote[0][0] && $nb_concours[0][0] >= 6){
// Do we have to post a vote ?
$deja_vote = 0;
if (!empty($_POST)){
    if (isset($_POST["nom_image"]) && strlen($_POST["nom_image"]) == 7){
        $current_ip = $_SERVER["REMOTE_ADDR"];

        // Add fellow to votelist
        $votant_query = "SELECT * FROM votant";
        $requete = $sql_bdd -> prepare($votant_query);
        $requete -> execute();
        $votant = $requete -> fetchAll();

        $inside = false;
        foreach ($votant as $votant1) {
            foreach ($votant1 as $votant2) {
                if ($current_ip === $votant2){
                    $inside = true;
                }
            }
        }

        if (!$inside) {
            $add_votant_query = "INSERT INTO votant VALUES (".$current_ip.", 0)";
            $requete = $sql_bdd -> prepare($add_votant_query);
            $requete -> execute();
        }

        
        $requete = $sql_bdd->prepare('SELECT last_vote FROM votant WHERE ip = "'. $current_ip .'"');
        $requete->execute();
        $votant = $requete->fetchAll();
        if (time()-$votant[0][0] >= 2) {
            // Vote for a given image (image in $_POST)
            $ajout="UPDATE concours
                SET nb_votes = nb_votes + 1
                WHERE image = '" . $_POST["nom_image"] . "'";

            $requete = $sql_bdd -> prepare($ajout);
            $requete -> execute();
            
            $votant_query = "UPDATE votant SET last_vote = '" . time() . "' WHERE ip = '" . $current_ip . "'";
            $requete = $sql_bdd -> prepare($votant_query);
            $requete -> execute();

            foreach ($_SESSION["last_seen"] as $enr) {
                // Increment image occurrence number
                $ajout="UPDATE concours
                    SET nb_fois = nb_fois + 1
                    WHERE id = '" . $enr . "'";

                $sth = $sql_bdd->prepare($ajout);
                $sth->execute();
                $result_ajout = $sth->fetchAll();
            }
        }
    }   
    $deja_vote = intval($_POST['deja_vote']);
}
if (isset($_COOKIE['NB_VOTE']) && $_COOKIE['NB_VOTE']>=$nombre_vote[0][0] && (!isset($_SESSION['LOGGED_USER']) || !$limite_vote[0][0])): ?>
    <br>
    <div class="alert alert-danger" role="alert">
    <?php $temps = $_COOKIE['cookie_exp']-time();
    echo "Vous ne pouvez voter que ". $nombre_vote[0][0] ." fois toute les ". $temps_vote[0][0] ." secondes. Vous pourrez revoter dans " . $temps . " secondes"; ?>
    </div>
    <br>
    <form action="index.php">
        <button type='submit'class="pure-button pure-button-primary" style="margin: 1em;">Actualiser</button>
    </form>
<?php else:?>
    <div>
        <form action="index.php" method="POST" class="vote">
            <?php
                // Take 6 random images from database
                $sql_images= "SELECT * FROM concours ORDER BY RAND() LIMIT 0,6 ;";

                $requete = $sql_bdd->prepare($sql_images);
                $requete->execute();
                $result_images = $requete->fetchAll();

                $images_ids = array();
                    
                // For each image
                foreach ($result_images as $enr) {
                    $images_id[] = $enr["id"];

                    // Print HTML code for a clickable image
                    echo "
                    <div class='choice'>
                        <input type='radio' name='nom_image' value='{$enr['image']}' id='{$enr['image']}' onclick='this.form.submit()'>
                        <label class='item' for='{$enr['image']}'>
                            <div class='lr-borders'></div>
                            <img class='image' src='images/{$enr['image']}' alt='image {$enr['image']}'>
                        </label>
                    </div>";
                }
                echo "<input name='deja_vote' type='hidden' value='" . ($deja_vote + 1) . "'>";

                $_SESSION["last_seen"] = $images_id;
            ?>
        </form>
    </div>
<?php endif;
} elseif ($nb_concours[0][0] <= 6){
    echo '<div class="alert alert-danger" role="alert">Il n\'y a pas assez d\'image disponible</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Le vote est actuellement désactivé</div>';
}