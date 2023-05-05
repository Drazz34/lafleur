<?php

include './modele/M_Categorie.php';
include './modele/M_Article.php';

// Gestion de la session pour le bouton "Commander"
if (isset($_SESSION['client'])) {
    $url_commande = "index.php?page=commande";
} else {
    $url_commande = "index.php?page=connexion";
}

// Variable pour afficher tous les articles
$articles = M_Article::afficheTousLesArticles();

// Variable pour afficher tous les articles d'une catégorie
if (isset($_GET['categorie'])) {
    $id = filter_input(INPUT_GET, 'categorie', FILTER_SANITIZE_NUMBER_INT);
    $articlesDUneCategorie = M_Article::afficheLesArticlesDUneCategorie($id);
}

// Variable pour afficher tous les articles par couleur
if (isset($_GET['couleur'])) {
    $id = filter_input(INPUT_GET, 'couleur', FILTER_SANITIZE_NUMBER_INT);
    $articlesDUneCouleur = M_Article::afficheLesArticlesParCouleur($id);
}

// Variable pour afficher tous les articles par catégorie et par couleur
if (isset($_GET['categorie']) && isset($_GET['couleur'])) {
    $id_categorie = filter_input(INPUT_GET, 'categorie', FILTER_SANITIZE_NUMBER_INT);
    $id_couleur = filter_input(INPUT_GET, 'couleur', FILTER_SANITIZE_NUMBER_INT);
    $articlesDUneCategorieEtDUneCouleur = M_Article::afficheLesArticlesParCategorieEtParCouleur($id_categorie, $id_couleur);
}

$categories = M_Categorie::afficheIdNomCategories();

$couleurs = M_Article::AfficheLesCouleurs();