<?php

include_once './modele/M_Article.php';
include_once "./modele/M_Profil.php";
include_once "./modele/M_Commande.php";

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

$codesPostaux = M_Commande::afficheCP();
$codesPostaux1 = M_Commande::afficheCP1();

$villesLivrables = M_Commande::afficheVille();

var_dump($codesPostaux);
var_dump($villesLivrables);
var_dump($codesPostaux1);
