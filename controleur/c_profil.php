<?php

include_once "./modele/M_Commande.php";
include_once "./modele/M_Profil.php";
include_once "./modele/M_Client.php";

$client = M_Client::trouverClientParId($_SESSION['client']['id']);

$commandesClient = [];

if (!empty($client)) {
    $commandesClient = M_Commande::afficherCommandes($client['id']);
}


$adresse = M_Profil::adresseClient($client['id']);

if (!empty($_POST['modif_submit'])) {
    $nouvelEmail = $_POST['modif_email'];
    $nouveauNom = $_POST['modif_nom'];
    $nouveauPrenom = $_POST['modif_prenom'];
    $nouvelleRue = $_POST['modif_rue'];
    $nouveauCp = $_POST['modif_cp'];
    $nouvelleVille = $_POST['modif_ville'];
    $ancienMotDePasse = $_POST['modif_ancien_password'];
    $nouveauMotDePasse = $_POST['modif_password'];

    // Vérifier si le mot de passe actuel est correct avant de mettre à jour le mot de passe
    // Vérification que l'ancien mot de passe est correct
    $client = M_Client::trouverClientParId($_SESSION['client']['id']);
    if (!password_verify($ancienMotDePasse, $client['mot_de_passe'])) {
        $msg_erreur = 'Le mot de passe actuel est incorrect.';
    } else {
        // Si le mot de passe actuel est incorrect ou vide, on ne met pas à jour le mot de passe
        $nouveauMotDePasse = $client['mot_de_passe'];
    }

    // Mettre à jour les données du client dans la base de données
    M_Profil::mettreAJourClient($_SESSION['client']['id'], $nouvelEmail, $nouveauMotDePasse, $nouveauNom, $nouveauPrenom, $nouvelleRue, $nouveauCp, $nouvelleVille);

    // Récupérer les nouvelles données du client depuis la base de données
    $client = M_Client::trouverClientParId($_SESSION['client']['id']);
    if (!empty($client)) {
        $_SESSION['client'] = $client;
    }
    $adresse = M_Profil::adresseClient($client['id']);

}