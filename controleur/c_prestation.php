<?php

include './modele/M_Categorie.php';

/**
 * Controleur pour la consultation des articles par catégorie
 */



if ($page == "prestations") {
    $lesCategories = M_Categorie::trouveLesCategories();
}