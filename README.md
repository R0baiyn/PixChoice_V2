# PixChoice

La V1 de PixChoice trouvable ici : [PixChoiceV1](https://github.com/m4th2/PixChoice)

La V2 de PixChoice en ligne sur [nsi42.net/085/PixchoiceV2/](https://nsi42.net/085/PixchoiceV2/)

## V2 ?

Voici ce que rajoute la V2 de PixChoice :

* Configuration du vote

   * Activation / Désactivation du vote.

   * Activation / Désactivation du vote pour les admins malgré la limite. (permet aux administrateurs de voter sans limites)
  
   * Gestion du nombre de vote avant d'être bloqué
  
   * Gestion du temps avant d'être débloqué

* Configuration des images

   * Ajout d'image (avec gestion de formatage du nom et d'id dans la db)
  
   * Suppression d'images (avec gestion dans la db)

* Configuration des résultats

   * Activation / Désactivation des résultats pour tous.
  
   * Activation / Désactivation de l'affichage des résultats pour les admins.

* Gestion des utilisateurs
  
   * Ajout d'utilisateurs avec génération de mot de passe temporaire aléatoire
  
   * Tableau référençant les utilisateurs qui permet d'en supprimer ou d'activer ou non le fait qu'ils soient superadmin (seul les superadmin ont accès à cette page)

* Configuration du compte
  
   * Modification de l'identifiant
  
   * Modification du mot de passe

# Mise en place sur votre serveur

Afin de mettre en place PixChoice_V2 sur votre serveur :

1. Uploadez les fichiers sur le serveur.
2. Modifiez config.php pour que les variables correspondent à votre base de donnée et choisissez un hash pour sécuriser les mot de passe de vos utilisateurs.
3. Ajoutez dans la base de donnée un utilisateur depuis votre base de donnée avec son identifiant, son mot de passe hashé, et un 1 dans la colonne superadmin
4. Vous pouvez désormais accéder à votre PixChoice V2 avec les permissions administrateurs
