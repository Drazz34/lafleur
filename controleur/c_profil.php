<?php

include_once "./modele/M_Commande.php";
include_once "./modele/M_Profil.php";
include_once "./modele/M_Client.php";

if (!empty($_SESSION['client'])) {
    $client = $_SESSION['client'];
    $commandesClient = M_Commande::afficherCommandes($client['id']);
    $adresse = M_Profil::adresseClient($client['id']);
    $fraisLivraison = M_Commande::afficheFraisLivraison($client['id']);
}

if (!empty($_POST['modif_submit'])) {
    $nouvelEmail = $_POST['modif_email'];
    $nouveauNom = $_POST['modif_nom'];
    $nouveauPrenom = $_POST['modif_prenom'];
    $nouvelleRue = $_POST['modif_rue'];
    $nouveauCp = $_POST['modif_cp'];
    $nouvelleVille = $_POST['modif_ville'];
    $ancienMotDePasse = $_POST['modif_ancien_password'];
    $nouveauMotDePasse = $_POST['modif_password'];

    $client = M_Client::trouverClientParId($_SESSION['client']['id']);
    // Si le mot de passe actuel est correct et que le nouveau mot de passe n'est pas vide, mettez à jour le mot de passe
    if (password_verify($ancienMotDePasse, $client['mot_de_passe']) && !empty($nouveauMotDePasse)) {
        $motDePasse = password_hash($nouveauMotDePasse, PASSWORD_DEFAULT);
    } else {
        echo "<script>alert('Le mot de passe actuel est incorrect.');</script>";
        $motDePasse = $client['mot_de_passe'];
    }

    // Mettre à jour les données du client dans la base de données
    M_Profil::mettreAJourClient($_SESSION['client']['id'], $nouvelEmail, $motDePasse, $nouveauNom, $nouveauPrenom, $nouvelleRue, $nouveauCp, $nouvelleVille);

    // Récupérer les nouvelles données du client depuis la base de données
    $client = M_Client::trouverClientParId($_SESSION['client']['id']);
    if (!empty($client)) {
        $_SESSION['client'] = $client;
    }
    $adresse = M_Profil::adresseClient($client['id']);

}

if (isset($_POST['deconnexion']) && $_POST['deconnexion'] == 'true') {
    session_unset(); // Supprimer la variable de session
    session_destroy(); // Détruire la session
    header('Location: index.php'); // Rediriger vers la page d'accueil
    exit();
}