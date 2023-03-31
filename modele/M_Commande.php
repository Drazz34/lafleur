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

    // Affiche les codes postaux disponibles pour livraison

    public static function afficheCP()
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT code_postal FROM lf_codes_postaux WHERE id=1 OR id=2");
        $stmt->execute();
        $codesPostaux = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $codesPostaux;
    }

    // Affiche les villes disponibles pour livraison

    public static function afficheVille()
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT nom_ville FROM lf_villes WHERE livrable=1");
        $stmt->execute();
        $villes = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $villes;
    }
}