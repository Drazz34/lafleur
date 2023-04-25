<?php

// Inclusion des fichiers nécessaires
// require_once 'acces_donnees.php';
require_once './modele/M_Client.php';

// Connexion d'un client déjà inscrit
if (isset($_POST['connexion_submit'])) {
    // Récupération des données soumises par le formulaire
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');

    // Trouver le client par email
    $client = M_Client::trouverClientParEmail($email);

    if (!$client || !password_verify($password, $client["mot_de_passe"])) {
        echo '<script>alert("Données saisies incorrectes ou client non-inscrit");</script>';
    } else {
        $_SESSION['client'] = $client;

        echo '<script>alert("Vous êtes bien connecté(e) ' . $client["prenom"] . ' !");</script>';
        echo '<script>window.location.replace("index.php?page=profil");</script>'; // Redirection avec JavaScript
        exit; // Arrêt de l'exécution du script
    }
}

// Traitement du formulaire de création de client
if (isset($_POST['submit'])) {
    // Récupération des données soumises par le formulaire
    $email = filter_input(INPUT_POST, 'creation_email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'creation_password');
    $nom = filter_input(INPUT_POST, 'creation_nom');
    $prenom = filter_input(INPUT_POST, 'creation_prenom');
    $rue = filter_input(INPUT_POST, 'creation_rue');
    $cp = filter_input(INPUT_POST, 'creation_cp', FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/^\d{5}$/')));
    $ville = filter_input(INPUT_POST, 'creation_ville');

    // Création du nouveau client avec l'adresse associée
    M_Client::creerClient($email, $password, $nom, $prenom, $rue, $cp, $ville);

    // Affichage d'un message de confirmation dans un popup
    echo '<script>alert("Inscription validée !");</script>';
}