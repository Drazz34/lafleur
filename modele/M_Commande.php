<?php

class M_Commande
{

    // Affiche les informations des commandes d'un client

    public static function afficherCommandes($idClient)
    {
        $pdo = Accesdonnees::getPdo();
        $stmt = $pdo->prepare("SELECT lf_commandes.id, lf_articles.nom AS nom, DATE_FORMAT(lf_commandes.date_commande, '%d-%m-%Y') AS date_de_commande, lf_articles.prix_unitaire AS prix
        FROM lf_clients
        JOIN lf_commandes ON lf_clients.id = lf_commandes.client_id
        JOIN lf_articles ON lf_commandes.article_id = lf_articles.id
        WHERE lf_clients.id = :clientId
        ORDER BY lf_commandes.id");
        $stmt->bindParam(":clientId", $idClient);
        $stmt->execute();
        $lesCommandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $lesCommandes;
    }
}
