<?php

class M_Article
{
    /**
     * Retourne tous les articles sous la forme d'un tableau associatif
     * 
     * @return array
     */

    public static function afficheTousLesArticles()
    {
        $req = "SELECT * FROM lf_articles";
        $res = AccesDonnees::query($req);
        $lesLignes = $res->fetchAll(PDO::FETCH_ASSOC);
        return $lesLignes;
    }

    /**
     * Retourne tous les articles d'une catégorie sous la forme d'un tableau associatif
     * 
     * @return array
     */

    public static function afficheLesArticlesDUneCategorie()
    {
    }
}
