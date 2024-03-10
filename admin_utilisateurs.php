<?php
?>
<div id="main">
    <div class="header">
        <h1>Gestion des utilisateurs</h1>
    </div>
    <div class="content">
    <h2 class="content-subhead">Cette page permet de gérer les utilisateurs (superadmin seulement)</h2>
    <?php if (!$_SESSION['LOGGED_USER']['superadmin']){
    echo '<div class="alert alert-danger" role="alert" style="position: relative; padding: 1rem 1rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem; color: #842029; background-color: #f8d7da; border-color: #f5c2c7;">Vous ne pouvez pas accéder à la page de gestion des utilisateurs car vous n\'êtes pas superadmin.</div>';
    exit();}?> 
    <h2 class="content-subhead">Ajouter un utilisateur</h2>
    <form method="post" action="update_users.php" class="pure-form">
        <input type="text" id="aligned-name" placeholder="Identifiant" name="newuser_id"/>
        <label for="aligned-name">Identifiant du nouvel utilisateur</label><br><br>
        <button type="submit" class="pure-button pure-button-primary">Ajouter un utilisateur</button>
    </form>
    <h2 class="content-subhead">Gestion des utilisateurs</h2>
    <table class="pure-table">
        <thead>
            <tr>
                <th>id_user</th>
                <th>identifiant</th>
                <th>new_user</th>
                <th>superadmin</th>
                <th>on/off superadmin</th>
                <th>supprimer</th>
            </tr>
        </thead>
        <tbody>            
            <?php
            foreach ($users as $user){
                echo "
                <tr>
                    <td>".$user['id_user']."</td>
                    <td>".$user['identifiant']."</td>
                    <td>".$user['new_user']."</td>
                    <td>".$user['superadmin']."</td>
                    <td><form class='pure-form' method='post' action='update_users.php'><input type='hidden' name='toggle_superadmin' value='".$user['id_user']."'>
                    <center><button type='submit' class='pure-button' style='background: rgb(28, 184, 65); color: white;'>Changer</button></center>
                    </form></td>
                    <td><form class='pure-form' method='post' action='update_users.php'><input type='hidden' name='remove_user' value='".$user['id_user']."'>
                    <center><button type='submit' class='pure-button' style='background: rgb(202, 60, 60); color: white;'>Supprimer</button></center>
                    </form></td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
