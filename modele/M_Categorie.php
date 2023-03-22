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
      $req = "SELECT * FROM lf_categories";
      $res = AccesDonnees::query($req);
      $lesLignes = $res->fetchAll(PDO::FETCH_ASSOC);
      return $lesLignes;
   }

   /**
    * Retourne une catégorie sous la forme d'un tableau associatif
    *
    * @return array
    */

   public static function trouveUneCategorie($id)
   {
      $pdo = AccesDonnees::getPdo();
      $req = $pdo->prepare("SELECT * FROM lf_categories WHERE id= :id");
      $req->bindParam(":id", $id);
      $req->execute();
      $categorie = $req->fetch(PDO::FETCH_ASSOC);
      return $categorie;
   }
}
