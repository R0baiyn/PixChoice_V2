<?php 
// Do we have to post a vote ?
$deja_vote = 0;
if (!empty($_POST)){
    if (isset($_POST["nom_image"]) && strlen($_POST["nom_image"]) == 7){
        // Vote for a given image (image in $_POST)
        $ajout="UPDATE concours
            SET nb_votes = nb_votes + 1
            WHERE image = '" . $_POST["nom_image"] . "'";

        $requete = $sql_bdd -> prepare($ajout);
        $requete -> execute();

        // Add fellow to votelist
        $votant_query = "SELECT * FROM votant";
        $requete = $sql_bdd -> prepare($votant_query);
        $requete -> execute();
        $votant = $requete -> fetchAll();

        $current_ip = $_SERVER["REMOTE_ADDR"];

        if (!in_array($current_ip, $votant[0])) {
            $add_votant_query = "INSERT INTO votant VALUES (?)";
            $requete = $sql_bdd -> prepare($add_votant_query);
            $requete -> execute(array($current_ip));
        }

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
    $deja_vote = intval($_POST['deja_vote']);
}
if (isset($_COOKIE['NB_VOTE']) && $_COOKIE['NB_VOTE']>=10): ?>
    <br>
    <div class="alert alert-danger" role="alert">
    <?php $temps = $_COOKIE['cookie_exp']-time();
    echo "Vous ne pouvez voter que 10 fois par heure. Vous pourrez revoter dans " . $temps . " secondes"; ?>
    </div>
    <br>
    <form action="index.php">
        <button type='submit'class="pure-button pure-button-primary">Actualiser</button>
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
<?php endif;?>