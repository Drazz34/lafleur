<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            include "vue/content/prestation_content.php";
            break;
        case 'boutique':
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

    ?>
    <script src="./js/main.js"></script>
    <script>
// récupérer le formulaire
var form = document.querySelector('form');

// ajouter un événement de soumission au formulaire
form.addEventListener('submit', function(event) {
  // empêcher l'envoi normal du formulaire
  event.preventDefault();
  
  // envoyer le formulaire en utilisant AJAX
  var xhr = new XMLHttpRequest();
  xhr.open('POST', form.action);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    // afficher le message de confirmation dans un popup
    alert('Merci de nous avoir contactés. Nous vous répondrons dans les plus brefs délais.');
  };
  xhr.send(new FormData(form));
});


function clearForm() {
  document.getElementById("contact_nom").value = "";
  document.getElementById("contact_email").value = "";
  document.getElementById("contact_telephone").value = "";
  document.getElementById("contact_message").value = "";
}
</script>

</body>

</html>