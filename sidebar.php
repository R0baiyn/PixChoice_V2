<?php
$getData = $_GET
?>

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
                <li class="pure-menu-item <?php if (isset($getData['Home'])){echo "pure-menu-selected";}?>">
                    <a href="?Home" class="pure-menu-link">Home</a>
                </li>
                <li class="pure-menu-item <?php if (isset($getData['About'])){echo "menu-item-divided pure-menu-selected";}?>">
                    <a href="?About" class="pure-menu-link">About</a>
                </li>

                <li class="pure-menu-item <?php if (isset($getData['Services'])){echo "menu-item-divided pure-menu-selected";}?>">
                    <a href="?Services" class="pure-menu-link">Services</a>
                </li>

                <li class="pure-menu-item <?php if (isset($getData['Contact'])){echo "menu-item-divided pure-menu-selected";}?>">
                    <a href="?Contact" class="pure-menu-link">Contact</a>
                </li>
            </ul>
        </div>
    </div>