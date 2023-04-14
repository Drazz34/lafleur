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
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM lf_articles");
        $stmt->execute();
        $lesArticles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $lesArticles;
    }

    /**
     * Retourne les informations  d'un article sous la forme d'un tableau associatif
     * 
     * @return array
     */

    public static function afficheUnArticle($id)
    {
        $pdo = AccesDonnees::getPdo();
        $req = $pdo->prepare("SELECT * FROM lf_articles WHERE lf_articles.id = :id;");
        $req->bindParam(":id", $id);
        $req->execute();
        $unArticle = $req->fetch(PDO::FETCH_ASSOC);
        return $unArticle;
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
        $req = $pdo->prepare("SELECT lf_articles.id, lf_articles.nom, lf_articles.prix_unitaire, lf_articles.quantite_dispo, lf_articles.photo, lf_articles.alt, lf_articles.couleur_id, lf_couleurs.id as couleur_id, lf_couleurs.nom_couleur as couleur_nom FROM lf_articles
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

    /**
     * Met à jour la quantité de l'article acheté
     *
     * @param [type] $article_id
     * @param [type] $quantite_achetee
     * @return void
     */
    public static function MAJQuantiteArticle($article_id, $quantite_achetee)
    {
        $pdo = Accesdonnees::getPdo();
        $stmt = $pdo->prepare("UPDATE lf_articles SET quantite_dispo = quantite_dispo - :quantite_achetee WHERE id = :article_id");
        $stmt->bindParam(":quantite_achetee", $quantite_achetee, PDO::PARAM_INT);
        $stmt->bindParam(":article_id", $article_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * Affiche le nom des couleurs
     * 
     * @return array
     */
    public static function AfficheLesCouleurs()
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM lf_couleurs");
        $stmt->execute();
        $couleurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $couleurs;
    }
}
