<?php
    
    $page = filter_input(INPUT_GET, "page");

    // $action = filter_input(INPUT_GET, "action");

    require("modele/AccesDonnees.php");

    include "vue/common/template.php";