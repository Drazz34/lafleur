<?php

class M_Categorie {
    /**
     * Retourne toutes les catégories sous la forme d'un tableau associatif
     * 
     * @return array
     */

     public static function trouveLesCategories() {
        $req = "SELECT * FROM lf_categories";
        $res = AccesDonnees::query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
     }
}