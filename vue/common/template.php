<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" integrity="sha512-WEQNv9d3+sqyHjrqUZobDhFARZDko2wpWdfcpv44lsypsSuMO0kHGd3MQ8rrsBn/Qa39VojphdU6CMkpJUmDVw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">
    <title>LaFleur</title>
</head>

<body>

    <?php

    include "header.php";

    if (!isset($page)) {
        $page = "accueil";
    }

    switch ($page) {
        case 'accueil':
            include "vue/content/accueil_content.php";
            break;
        case 'presentation':
            include "vue/content/presentation_content.php";
            break;
        case 'prestations':
            include "controleur/c_prestation.php";
            include "vue/content/prestation_content.php";
            break;
        case 'boutique':
            include "controleur/c_boutique.php";
            include "vue/content/boutique_content.php";
            break;
        case 'contact':
            include "vue/content/contact_content.php";
            break;
        case 'connexion':
            include "vue/content/connexion_content.php";
            break;
        default:
            include "vue/content/404.html";
            break;
    }


    include "footer.php";

    // URL de la page contact à clean après le popup
    if (isset($_GET['success']) && $_GET['success'] == 'true') {
        echo "<script>alert('Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');</script>";
        $params = $_GET;
        unset($params['success']);
        $url = 'https://villac.needemand.com/site_lafleur/index.php?page=contact';
        echo "<script>window.location.href='$url';</script>";
    }

    if (isset($_GET['success']) && $_GET['success'] == 'false') {
        echo "<script>alert('Votre message n\'a pas pu être envoyé, veuillez recommencer s\'il vous plait.');</script>";
        $params = $_GET;
        unset($params['success']);
        $url = 'https://villac.needemand.com/site_lafleur/index.php?page=contact';
        echo "<script>window.location.href='$url';</script>";
    }

    if (isset($_GET['success']) && $_GET['success'] == 'obli') {
        echo "<script>alert('Veuillez remplir tous les champs s\'il vous plait.');</script>";
        $params = $_GET;
        unset($params['success']);
        $url = 'https://villac.needemand.com/site_lafleur/index.php?page=contact';
        echo "<script>window.location.href='$url';</script>";
    }
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/main.js"></script>

</body>

</html>