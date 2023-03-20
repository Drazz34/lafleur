<?php
    
    $page = filter_input(INPUT_GET, "page");

    require("modele/AccesDonnees.php");

    include "vue/common/template.php";