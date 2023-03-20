<?php

include './modele/M_Categorie.php';

/**
 * Controleur pour la consultation des articles par catégorie
 */

//  switch ($page) {
//     case 'prestations':
//         $lesCategories = M_Categorie::trouveLesCategories();
        
//         break;
    
//     default:
        
//         break;
// }

if ($page == "prestations") {
    $lesCategories = M_Categorie::trouveLesCategories();
}