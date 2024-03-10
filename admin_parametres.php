<div id="main">
    <div class="header">
        <h1>Configuration du compte</h1>
    </div>

    <div class="content">
            <h2 class="content-subhead">Cette page permet de configurer votre compte, de modifier votre indentifiant ou votre mot de passe.</h2>

            <?php if (isset($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
            <div class="alert alert-danger" role="alert" style="position: relative; padding: 1rem 1rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem; color: #842029; background-color: #f8d7da; border-color: #f5c2c7;">
                <?php echo $_SESSION['LOGIN_ERROR_MESSAGE'];
                unset($_SESSION['LOGIN_ERROR_MESSAGE']); ?>
            </div>
            <?php endif; ?>

            <h2 class="content-subhead">Changer identifiant</h2>

            <form method="post" action="admin_update.php" class="pure-form">
                <div class="pure-control-group">
                    <input type="text" id="aligned-name" placeholder="Nouvel identifiant" name="id_new"/>
                    <label for="aligned-name">Nouvel identifiant</label><br><br>
                    <input type="text" id="aligned-name" placeholder="Identifiant actuel" name="id_actuel"/>
                    <label for="aligned-name">Identifiant actuel</label><br><br>
                    <input type="password" id="aligned-name" placeholder="Mot de passe" name="password_actuel"/>
                    <label for="aligned-name">Mot de passe</label><br><br>
                    <button type="submit" class="pure-button pure-button-primary">Appliquer les changements</button>
                </div>
            </form>
            <h2 class="content-subhead">Changer mot de passe</h2>

            <form method="post" action="admin_update.php" class="pure-form">
                <div class="pure-control-group">
                    <input type="text" id="aligned-name" placeholder="Identifiant actuel" name="id_actuel"/>
                    <label for="aligned-name">Identifiant actuel</label><br><br>
                    <input type="password" id="aligned-name" placeholder="Mot de passe actuel" name="password_actuel"/>
                    <label for="aligned-name">Mot de passe actuel</label><br><br>
                    <input type="password" id="aligned-name" placeholder="Nouveau mot de passe" name="password_new"/>
                    <label for="aligned-name">Nouveau mot de passe</label><br><br>
                    <button type="submit" class="pure-button pure-button-primary">Appliquer les changements</button>
                </div>
            </form>
    </div>
</div>

