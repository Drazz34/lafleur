<?php

// var_dump($_POST);

if (!empty($_POST)) {
    // Vérifier que les champs obligatoires ne sont pas vides
    if (empty($_POST['nom']) || empty($_POST['email']) || empty($_POST['message'])) {
        header('Location: https://villac.needemand.com/site_lafleur/index.php?page=contact&success=obli');
        exit;
    }

    // Préparation des informations de l'email
    $to = 'jfvillac@hotmail.com';
    $subject = 'Envoi depuis page Contact';
    $message = '<h1>Message envoyé depuis la page Contact de monsite.fr</h1>
                <p><b>Nom : </b>' . htmlspecialchars($_POST['nom']) . '<br>
                <b>Email : </b>' . htmlspecialchars($_POST['email']) . '<br>
                <b>Téléphone : </b>' . htmlspecialchars($_POST['telephone']) . '<br>
                <b>Message : </b>' . htmlspecialchars($_POST['message']) . '</p>';
    $headers = "From: webmaster@monsite.fr\r\n";
    $headers .= "Reply-To: " . $_POST['email'] . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
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
