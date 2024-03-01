<style>
input[type=file]::file-selector-button {
  margin-right: 20px;
  border: none;
  background: #084cdf;
  padding: 10px 20px;
  border-radius: 2px;
  color: #fff;
  cursor: pointer;
  transition: background .2s ease-in-out;
}

input[type=file]::file-selector-button:hover {
  background: #0d45a5;
}
</style>
<div id="main">
    <div class="header">
        <h1>Configuration des images</h1>
    </div>
    <div class="content">
            <h2 class="content-subhead">Cette page permet de s'occuper des images, d'en supprimer ou d'en ajouter.</h2>
            <h2 class="content-subhead">Ajout d'images</h2>

            <form action="add_images.php" method="post" enctype="multipart/form-data">
                <input type="file" id="screenshot" name="screenshot[]" multiple accept="image/png"/><br><br>
                <button type="submit" class="pure-button pure-button-primary" style="background: rgb(28, 184, 65);">Ajouter ces images</button>
            </form>
            <h2 class="content-subhead">Suppression de toutes les images</h2>
            <form method="get" action="delete_images.php">
                <button class="pure-button pure-button-primary" style="background: rgb(202, 60, 60);" name='all'>Supprimer toutes les images</button>
            </form>
            <h2 class="content-subhead">Suppression d'image selon la sélection</h2>
            
            <form action="delete_images.php" method="post">
                <button type="submit" class="pure-button pure-button-primary">Supprimer la sélection</button><br><br>

<?php
$requete = $sql_bdd->prepare("SELECT * FROM concours");
$requete->execute();
$images = $requete->fetchAll();
foreach ($images as $image) {
    echo "<li>" . '<input type="checkbox" name="' . $image["image"] . '" value= "'. $image["image"] .'"/> '  . $image["image"] ."<br><br><img style='width: 42%;' class='pure-img' src='images/".$image["image"]."'></li><br>";
}