<div id="main">
    <div class="header">
        <h1>Configuration du vote</h1>
    </div>
    <div class="content">
            <h2 class="content-subhead"></h2>
            <p>
                Cette page permet de configurer le vote, vous pouvez activer ou non la possibilité de voter, le nombre de vote sur une certaine durée, et la durée en question.
            </p>
            <form method="post" action="admin.php?Vote" class="pure-form">
            <h2 class="content-subhead">Activation / Désactivation du vote.</h2>
            <div style="margin-top: 15px;">
                <label class="switch">
                    <input type="checkbox" name="variable">
                    <span class="slider round"></span>
                </label>
            </div>
            <p>affichage en php si le vote est actif ou non</p>
            
            <h2 class="content-subhead">Activation / Désactivation du vote pour les admins malgré la limite.</h2>
            <div style="margin-top: 15px;">
                <label class="switch">
                    <input type="checkbox" name="variable">
                    <span class="slider round"></span>
                </label>
            </div>
            <p>affichage en php si le vote est possible pour les admins ou pas</p>

            <h2 class="content-subhead">Nombre de vote possible sur un temps donné</h2>
            <div class="pure-control-group">
                <label for="aligned-name">Nombre de vote</label>
                <input type="text" id="aligned-name" placeholder="Identifiant" name="identifiant"/>
            </div>
            <h2 class="content-subhead">Temps avant de pouvoir revoter</h2>
            <div class="pure-control-group">
                <label for="aligned-name">Temps</label>
                <input type="text" id="aligned-name" placeholder="Identifiant" name="identifiant"/>
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