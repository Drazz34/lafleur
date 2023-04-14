<?php

class M_Categorie
{
   /**
    * Retourne toutes les catégories sous la forme d'un tableau associatif
    * 
    * @return array
    */

   public static function trouveLesCategories()
   {
      $pdo = AccesDonnees::getPdo();
      $stmt = $pdo->prepare("SELECT * FROM lf_categories");
      $stmt->execute();
      $lesLignes = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $lesLignes;
   }

   public static function afficheIdNomCategories()
   {
      $pdo = AccesDonnees::getPdo();
      $stmt = $pdo->prepare("SELECT id, nom FROM lf_categories");
      $stmt->execute();
      $affiche = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $affiche;
   }
}
