<?php

include './modele/M_Categorie.php';
include './modele/M_Article.php';

if (!isset($_GET['categorie']) && $page == "boutique") {
    $articles = M_Article::afficheTousLesArticles();
    
}

if (isset($_GET['categorie']) && $page == "boutique") {
    $id = $_GET['categorie'];
    $categorie = M_Categorie::trouveUneCategorie($id);
}