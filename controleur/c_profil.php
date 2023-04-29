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

    $nouvelEmail = filter_input(INPUT_POST, 'modif_email', FILTER_SANITIZE_EMAIL);
    $nouveauNom = filter_input(INPUT_POST, 'modif_nom');
    $nouveauPrenom = filter_input(INPUT_POST, 'modif_prenom');
    $nouvelleRue = filter_input(INPUT_POST, 'modif_rue');
    $nouveauCp = filter_input(INPUT_POST, 'modif_cp', FILTER_SANITIZE_NUMBER_INT);
    $nouvelleVille = filter_input(INPUT_POST, 'modif_ville');
    $ancienMotDePasse = filter_input(INPUT_POST, 'modif_ancien_password');
    $nouveauMotDePasse = filter_input(INPUT_POST, 'modif_password');

    $client = M_Client::trouverClientParId($_SESSION['client']['id']);
    // Si le mot de passe actuel est correct et que le nouveau mot de passe n'est pas vide, mettez à jour le mot de passe
    if (!empty($ancienMotDePasse) && !empty($nouveauMotDePasse)) {
        if (password_verify($ancienMotDePasse, $client['mot_de_passe'])) {
            $motDePasse = password_hash($nouveauMotDePasse, PASSWORD_DEFAULT);
        } else {
            echo "<script>alert('Le mot de passe actuel est incorrect.');</script>";
            $motDePasse = $client['mot_de_passe'];
        }
    } else {
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
