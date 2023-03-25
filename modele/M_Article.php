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

    /**
     * Retourne tous les articles par catégorie et par couleur sous la forme d'un tableau associatif
     * 
     * @return array
     */

    public static function afficheLesArticlesParCategorieEtParCouleur($id_categorie, $id_couleur)
    {
        $pdo = AccesDonnees::getPdo();
        $req = $pdo->prepare("SELECT lf_articles.*, lf_categories.nom AS categorie, lf_couleurs.nom_couleur AS couleur
        FROM lf_articles
        JOIN lf_article_categorie ON lf_articles.id = lf_article_categorie.article_id
        JOIN lf_categories ON lf_article_categorie.categorie_id = lf_categories.id
        JOIN lf_couleurs ON lf_articles.couleur_id = lf_couleurs.id
        WHERE lf_categories.id = :categorie_id AND lf_couleurs.id = :couleur_id;");
        $req->bindParam(":categorie_id", $id_categorie);
        $req->bindParam(":couleur_id", $id_couleur);
        $req->execute();
        $articlesParCategorieEtParCouleur = $req->fetchAll(PDO::FETCH_ASSOC);
        return $articlesParCategorieEtParCouleur;
    }
}