<?php
if(isset($_POST['email'])) {

    // Mettez ici l'adresse e-mail où vous souhaitez recevoir les messages du formulaire de contact
    $email_to = "jfvillac@hotmail.com";
    $email_subject = "Nouveau message depuis le formulaire de contact";

    function died($error) {
        // Votre message d'erreur ici
        echo "Nous sommes désolés, mais des erreurs ont été détectées dans le formulaire que vous avez envoyé. ";
        echo "Ces erreurs apparaissent ci-dessous.<br /><br />";
        echo $error."<br /><br />";
        echo "Merci de corriger ces erreurs.<br /><br />";
        die();
    }

    // validation des champs du formulaire
    if(!isset($_POST['nom']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['message'])) {
        died('Nous sommes désolés, mais il semble y avoir un problème avec le formulaire que vous avez soumis.');
    }

    $name = $_POST['nom']; // obligatoire
    $email = $_POST['email']; // obligatoire
    $phone = $_POST['telephone']; // facultatif
    $message = $_POST['message']; // obligatoire

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/';

  if(!preg_match($email_exp,$email)) {
    $error_message .= 'L\'adresse e-mail que vous avez entrée ne semble pas être valide.<br />';
  }

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$name)) {
    $error_message .= 'Le nom que vous avez entré ne semble pas être valide.<br />';
  }

  if(strlen($message) < 2) {
    $error_message .= 'Le message que vous avez entré ne semble pas être valide.<br />';
  }

  if(strlen($error_message) > 0) {
    died($error_message);
  }

    $email_message = "Détails du formulaire de contact ci-dessous.\n\n";

    function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }
    
    // création de l'en-tête de l'e-mail
    $headers = 'From: '.$email."\r\n".
    'Reply-To: '.$email."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
    @mail($email_to, $email_subject, $email_message, $headers);  

    
}