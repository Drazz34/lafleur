<?php

include './modele/M_Categorie.php';

if (!isset($_GET['categorie']) && $page == "boutique") {
    
    
}

if (isset($_GET['categorie']) && $page == "boutique") {
    $id = $_GET['categorie'];
    $categorie = M_Categorie::trouveUneCategorie($id);
}