<?php

include_once "./modele/M_Article.php";
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

$villesCp1 = M_Commande::afficheVilleCp1();
$villesCp2 = M_Commande::afficheVilleCp2();

$frais_livraison = M_Commande::afficheFraisLivraison();

// Au paiement
if (isset($_POST['paiement_submit'])) {
    // Récupérer les données du formulaire
    $quantite = $_POST['quantite'];
    $livraison_nom = $_POST['livraison_nom'];
    $livraison_prenom = $_POST['livraison_prenom'];
    $livraison_rue = $_POST['livraison_rue'];
    $livraison_cp = $_POST['livraison_cp'];
    $livraison_ville = $_POST['livraison_ville'];
    $livraison_date = $_POST['livraison_date'];
    $prix_total = $_POST['prix_total'];
    $frais_livraison_id = $_POST['frais_livraison_id'];

    // Obtenir les frais de livraison gratuits et payants
    $frais_gratuit = $frais_livraison[0];
    $frais_payant = $frais_livraison[1];

    // Insérer l'adresse de livraison dans la table lf_adresses et récupérer l'ID de la nouvelle adresse
    $adresse_id = M_Commande::ajouterAdresseLivraison($livraison_rue, $livraison_cp, $livraison_ville);

    // Insérer la commande dans la table lf_commandes
    M_Commande::ajouterCommande($client['id'], $article_id, $quantite, $adresse_id, $livraison_date, $frais_livraison_id);

    // Rediriger vers une page de confirmation ou une autre page appropriée
    header('Location: index.php?page=profil');
    exit();
}