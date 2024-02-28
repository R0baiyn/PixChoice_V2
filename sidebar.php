<div id="layout">
<!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>
    <div id="menu">
        <div class="pure-menu">
            <a class="pure-menu-heading" href="index.php">PixChoice</a>

            <ul class="pure-menu-list">
                <li class="pure-menu-item <?php if (isset($getData['Vote'])){echo "pure-menu-selected";}?>">
                    <a href="?Vote" class="pure-menu-link">Vote</a>
                </li>
                <li class="pure-menu-item <?php if (isset($getData['Images'])){echo "pure-menu-selected";}?>">
                    <a href="?Images" class="pure-menu-link">Images</a>
                </li>
                <li class="pure-menu-item <?php if (isset($getData['Resultats'])){echo "menu-item-divided pure-menu-selected";}?>">
                    <a href="?Resultats" class="pure-menu-link">Résultats</a>
                </li>

                <li class="pure-menu-item <?php if (isset($getData['Utilisateurs'])){echo "menu-item-divided pure-menu-selected";}?>">
                    <a href="?Utilisateurs" class="pure-menu-link">Utilisateurs</a>
                </li>

                <li class="pure-menu-item <?php if (isset($getData['Parametres'])){echo "menu-item-divided pure-menu-selected";}?>">
                    <a href="?Parametres" class="pure-menu-link">Paramètres</a>
                </li>
            </ul>
        </div>
    </div>