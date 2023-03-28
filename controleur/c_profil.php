<?php

include_once "./modele/M_Commande.php";

$commandesClient = [];

if (!empty($client)) {
    $commandesClient = M_Commande::afficherCommandes($client['id']);
}