<?php

include './modele/M_Article.php';
include_once "./modele/M_Profil.php";

if (isset($_GET['article_id'])) {
    $article_id = $_GET['article_id'];
} else {
    // Redirigez vers une page d'erreur ou la page d'accueil si l'ID de l'article n'est pas défini.
    header('Location: index.php');
    exit();
}

// Variable pour afficher un article par son id
$article = M_Article::afficheUnArticle($article_id);

if (!empty($_SESSION['client'])) {
    $client = $_SESSION['client'];
    $adresse = M_Profil::adresseClient($client['id']);
}