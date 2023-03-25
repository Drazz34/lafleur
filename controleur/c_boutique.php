<?php

include './modele/M_Categorie.php';
include './modele/M_Article.php';

// Variable pour afficher tous les articles
$articles = M_Article::afficheTousLesArticles();

// Variable pour afficher tous les articles d'une catégorie
if (isset($_GET['categorie'])) {
    $id = $_GET['categorie'];
    $articlesDUneCategorie = M_Article::afficheLesArticlesDUneCategorie($id);
}

// Variable pour afficher tous les articles par couleur
if (isset($_GET['couleur'])) {
    $id = $_GET['couleur'];
    $articlesDUneCouleur = M_Article::afficheLesArticlesParCouleur($id);
}

// Variable pour afficher tous les articles par catégorie et par couleur
if (isset($_GET['categorie']) && isset($_GET['couleur'])) {
    $id_categorie = $_GET['categorie'];
    $id_couleur = $_GET['couleur'];
    $articlesDUneCategorieEtDUneCouleur = M_Article::afficheLesArticlesParCategorieEtParCouleur($id_categorie, $id_couleur);
}