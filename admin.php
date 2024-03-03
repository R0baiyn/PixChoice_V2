<?php
session_start();
require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/fonctions.php');
require_once(__DIR__ . '/variables.php');
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixchoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
    <link rel="stylesheet" href="css/menu_styles.css">
    <link rel="stylesheet" href="css/admin_styles.css">
    <script src="./js/ui.js"></script>
</head>
<body>

<?php
$getData = $_GET;
$postData = $_POST;
if (!isset($_SESSION['LOGGED_USER'])) {
    $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Vous ne pouvez pas accéder à cette page sans être connecté.';
    redirectToUrl('index.php?connexion');
}

include('sidebar.php');
if (isset($getData['Vote'])){
    include('admin_vote.php');
} elseif (isset($getData['Images'])){
    include('admin_images.php');
} elseif (isset($getData['Resultats'])){
    include('admin_resultats.php');
} elseif (isset($getData['Utilisateurs'])){
    include('admin_utilisateurs.php');
} elseif (isset($getData['Parametres'])){
    include('admin_parametres.php');
} elseif ($_SESSION['LOGGED_USER']['new_user']) {
    $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Vous devez changer votre mot de passe temporaire pour un mot de passe permanent.';
    include('admin_parametres.php');
} else {
    include('admin_main.php');
} ?>
</div>
</body>
</html>