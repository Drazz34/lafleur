<?php

if (!empty($_POST)) {
    // Vérifier que les champs obligatoires ne sont pas vides
    if (empty($_POST['nom']) || empty($_POST['email']) || empty($_POST['message'])) {
        header('Location: https://villac.needemand.com/site_lafleur/index.php?page=contact&success=obli');
        exit;
    }

    // filter input

    $nom = filter_input(INPUT_POST, 'nom');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $telephone = filter_input(INPUT_POST, 'telephone');
    $message = filter_input(INPUT_POST, 'message');


    // Préparation des informations de l'email
    $to = 'jfvillac@hotmail.com';
    $subject = 'Envoi depuis page Contact';
    $message = '<h1>Message envoyé depuis la page Contact de lafleur.fr</h1>
                <p><b>Nom : </b>' . htmlspecialchars($nom) . '<br>
                <b>Email : </b>' . htmlspecialchars($email) . '<br>
                <b>Téléphone : </b>' . htmlspecialchars($telephone) . '<br>
                <b>Message : </b>' . htmlspecialchars($message) . '</p>';
    $headers = "From: webmaster@lafleur.fr\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    // $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Envoi de l'email
    if (mail($to, $subject, $message, $headers)) {
        header('Location: https://villac.needemand.com/site_lafleur/index.php?page=contact&success=true');
        exit;        
    } else {
        header('Location: https://villac.needemand.com/site_lafleur/index.php?page=contact&success=false');
        exit;
    }
} else {
    header('Location: https://villac.needemand.com/site_lafleur/index.php?page=contact&success=false');
    exit;
}
