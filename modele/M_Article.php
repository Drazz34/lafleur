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
        $lesArticles = $res->fetchAll(PDO::FETCH_ASSOC);
        return $lesArticles;
    }

    /**
     * Retourne tous les articles d'une catégorie sous la forme d'un tableau associatif
     * 
     * @return array
     */

    public static function afficheLesArticlesDUneCategorie($id)
    {
        $pdo = AccesDonnees::getPdo();
        $req = $pdo->prepare("SELECT * FROM lf_articles 
        JOIN lf_article_categorie ON lf_articles.id = lf_article_categorie.article_id 
        WHERE lf_article_categorie.categorie_id = :id;");
        $req->bindParam(":id", $id);
        $req->execute();
        $articlesDUneCategorie = $req->fetchAll(PDO::FETCH_ASSOC);
        return $articlesDUneCategorie;
    }

    /**
     * Retourne tous les articles par couleur sous la forme d'un tableau associatif
     * 
     * @return array
     */
        
    public static function afficheLesArticlesParCouleur($id)
    {
        $pdo = AccesDonnees::getPdo();
        $req = $pdo->prepare("SELECT * FROM lf_articles
        JOIN lf_couleurs ON lf_articles.couleur_id = lf_couleurs.id
        WHERE lf_couleurs.id = :id;");
        $req->bindParam(":id", $id);
        $req->execute();
        $articlesParCouleur = $req->fetchAll(PDO::FETCH_ASSOC);
        return $articlesParCouleur;
    }
}