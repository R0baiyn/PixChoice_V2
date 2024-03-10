<?php if (!isset($_SESSION['LOGGED_USER'])) : ?>
    <form action="submit_login.php" method="POST" class="pure-form pure-form-aligned">
        <?php if (isset($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['LOGIN_ERROR_MESSAGE'];
                unset($_SESSION['LOGIN_ERROR_MESSAGE']); ?>
            </div>
        <?php endif; ?>
            <h3> Connexion à un compte administrateur :</h3>
            <div class="pure-control-group">
                <label for="aligned-name">Identifiant</label>
                <input type="text" id="aligned-name" placeholder="Identifiant" name="identifiant"/>
            </div>
            <div class="pure-control-group">
                <label for="aligned-password">Mot de passe</label>
                <input type="password" id="aligned-password" placeholder="Mot de passe" name="password"/>
            </div>
            <div class="pure-controls">
                <button type="submit" class="pure-button pure-button-primary" style="margin: 1em;">Se connecter</button>
            </div>
    </form>
<?php else: 
redirectToUrl('index.php');
endif;?>
