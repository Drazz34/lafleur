<?php

class M_Commande
{

    // Affiche toutes les informations des commandes d'un client

    public static function afficherCommandes($idClient)
    {
        $pdo = Accesdonnees::getPdo();
        $stmt = $pdo->prepare("SELECT commandes.id, jeux.nom AS jeux, jeux.version, consoles.nom AS console, etat_exemplaire.etat, categories.nom AS categorie, exemplaires.prix
        FROM client
        JOIN commandes ON commandes.client_id = client.id
        JOIN lignes_commande ON lignes_commande.commande_id = commandes.id
        JOIN exemplaires ON exemplaires.id = lignes_commande.exemplaire_id
        JOIN jeux ON jeux.id = exemplaires.jeux_id
        JOIN consoles ON consoles.id = exemplaires.consoles_id
        JOIN etat_exemplaire ON etat_exemplaire.id = exemplaires.etat_exemplaire_id
        JOIN categories ON categories.id = exemplaires.categorie_id
        WHERE client.id = :clientId
        ORDER BY commandes.id");
        $stmt->bindParam(":clientId", $idClient);
        $stmt->execute();
        $lesCommandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $lesCommandes;
    }
}
