<?php

include_once "./modele/M_Loterie.php";
include_once "./modele/M_Commande.php";

$gainLoterieId = null;

if (isset($_POST['prize_id'])) {
    $gainLoterieId = intval($_POST['prize_id']);
}

// Vérifie si le bouton "Valider le gain" a été cliqué
if (isset($_POST['valide_gain'])) {
    // Vérifie si $gainLoterieId est défini avant d'appeler la fonction
    if ($gainLoterieId !== null) {
        M_Commande::ajouterGainLoterieDerniereCommande($client['id'], $gainLoterieId);
    }
    header('Location: index.php?page=profil');
}

$gains = M_Loterie::afficheGains();