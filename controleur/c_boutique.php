<?php

include './modele/M_Categorie.php';
include './modele/M_Article.php';

// Variable pour afficher tous les articles
$articles = M_Article::afficheTousLesArticles();

// Variable pour afficher tous les articles d'une catégorie
if (isset($_GET['categorie'])) {
    $id = $_GET['categorie'];
}
$articlesDUneCategorie = M_Article::afficheLesArticlesDUneCategorie($id);