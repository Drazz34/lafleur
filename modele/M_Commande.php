<?php

class M_Commande
{

    /**
     * Affiche les informations des commandes d'un client
     *
     * @param int $idClient
     * @return array
     */
    public static function afficherCommandes($idClient)
    {
        $pdo = Accesdonnees::getPdo();
        $stmt = $pdo->prepare("SELECT lf_commandes.id, 
                                      lf_commandes.quantite * lf_articles.prix_unitaire 
                                      + CASE WHEN lf_commandes.frais_livraison_id = 1 THEN 0 ELSE 2.99 END AS prix, 
                                      lf_articles.nom AS nom, 
                                      DATE_FORMAT(lf_commandes.date_commande, '%d-%m-%Y') AS date_de_commande,
                                      lf_gains_loterie.lot AS gain
                                FROM lf_clients
                                JOIN lf_commandes ON lf_clients.id = lf_commandes.client_id
                                JOIN lf_articles ON lf_commandes.article_id = lf_articles.id
                                JOIN lf_frais_livraison ON lf_frais_livraison.id = lf_commandes.frais_livraison_id
                                LEFT JOIN lf_gains_loterie ON lf_gains_loterie.id = lf_commandes.gain_loterie_id
                                WHERE lf_clients.id = :clientId
                                ORDER BY lf_commandes.id");
        $stmt->bindParam(":clientId", $idClient);
        $stmt->execute();
        $lesCommandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $lesCommandes;
    }

    
    /**
     * Affiche les codes postaux disponibles pour livraison
     *
     * @return array
     */
    public static function afficheCP()
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT code_postal FROM lf_codes_postaux WHERE id=1 OR id=2");
        $stmt->execute();
        $codesPostaux = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $codesPostaux;
    }

    /**
     * Affiche les villes disponibles pour livraison pour le premier code postal
     *
     * @return array
     */
    public static function afficheVilleCp1()
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT DISTINCT nom_ville FROM lf_villes
        JOIN lf_adresses ON lf_villes.id = lf_adresses.ville_id
        JOIN lf_codes_postaux ON lf_codes_postaux.id = lf_adresses.code_postal_id
        WHERE livrable=1 AND code_postal = (SELECT code_postal FROM lf_codes_postaux WHERE id=1)");
        $stmt->execute();
        $villesCp1 = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $villesCp1;
    }

    /**
     * Affiche les villes disponibles pour livraison pour le deuxième code postal
     *
     * @return array
     */
    public static function afficheVilleCp2()
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT DISTINCT nom_ville FROM lf_villes
        JOIN lf_adresses ON lf_villes.id = lf_adresses.ville_id
        JOIN lf_codes_postaux ON lf_codes_postaux.id = lf_adresses.code_postal_id
        WHERE livrable=1 AND code_postal = (SELECT code_postal FROM lf_codes_postaux WHERE id=2)");
        $stmt->execute();
        $villesCp2 = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $villesCp2;
    }

    /**
     * Affiche les frais de livraison
     *
     * @return array
     */
    public static function afficheFraisLivraison()
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT frais FROM lf_frais_livraison");
        $stmt->execute();
        $frais_livraison = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $frais_livraison;
    }

    /**
     * Ajoute l'adresse de livraison
     *
     * @param string $rue
     * @param int $code_postal
     * @param int $ville
     * @return int
     */
    public static function ajouterAdresseLivraison($rue, $code_postal, $ville)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("INSERT INTO lf_adresses (rue, code_postal_id, ville_id) VALUES (:rue, (SELECT id FROM lf_codes_postaux WHERE code_postal = :code_postal), (SELECT id FROM lf_villes WHERE nom_ville = :ville))");
        $stmt->bindParam(":rue", $rue);
        $stmt->bindParam(":code_postal", $code_postal);
        $stmt->bindParam(":ville", $ville);
        $stmt->execute();

        // Récupérer l'ID de la nouvelle adresse
        $adresse_id = $pdo->lastInsertId();
        return $adresse_id;
    }

    /**
     * Permet de savoir la quantité restante d'un article
     *
     * @param int $article_id
     * @return int
     */
    public static function quantiteDispo($article_id)
    {
        $pdo = Accesdonnees::getPdo();
        $stmt = $pdo->prepare("SELECT quantite_dispo FROM lf_articles WHERE id = :article_id");
        $stmt->bindParam(":article_id", $article_id);
        $stmt->execute();
        $quantite_dispo = $stmt->fetch(PDO::FETCH_COLUMN);
        return $quantite_dispo;
    }

    /**
     * Ajoute une nouvelle commande
     *
     * @param int $client_id
     * @param int $article_id
     * @param int $quantite
     * @param int $adresse_id
     * @param string $livraison_date
     * @param int $frais_livraison_id
     * @param int $gain_loterie_id
     * @return int
     */
    public static function ajouterCommande($client_id, $article_id, $quantite, $adresse_id, $livraison_date, $frais_livraison_id, $gain_loterie_id)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("INSERT INTO lf_commandes (client_id, article_id, quantite, adresse_livraison, date_commande, date_livraison_souhaitee, frais_livraison_id, gain_loterie_id) VALUES (:client_id, :article_id, :quantite, :adresse_livraison, CURDATE(), :date_livraison, :frais_livraison_id, :gain_loterie_id)");
        $stmt->bindParam(":client_id", $client_id);
        $stmt->bindParam(":article_id", $article_id);
        $stmt->bindParam(":quantite", $quantite);
        $stmt->bindParam(":adresse_livraison", $adresse_id);
        $stmt->bindParam(":date_livraison", $livraison_date);
        $stmt->bindParam(":frais_livraison_id", $frais_livraison_id);
        $stmt->bindParam(":gain_loterie_id", $gain_loterie_id);
        $stmt->execute();

        // Récupère l'ID de la dernière commande insérée
        $commande_id = $pdo->lastInsertId();

        return $commande_id;
    }

    /**
     * Ajoute le gain de la loterie à la dernière commande
     *
     * @param int $clientId
     * @param int $gainLoterieId
     * @return void
     */
    public static function ajouterGainLoterieDerniereCommande($clientId, $gainLoterieId)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("UPDATE lf_commandes SET gain_loterie_id = :gain_loterie_id WHERE client_id = :client_id ORDER BY id DESC LIMIT 1");
        $stmt->bindParam(':gain_loterie_id', $gainLoterieId, PDO::PARAM_INT);
        $stmt->bindParam(':client_id', $clientId, PDO::PARAM_INT);
        $stmt->execute();

        // Met à jour la quantité du lot dans la table lf_gains_loterie
        $stmt = $pdo->prepare("SELECT quantite_totale FROM lf_gains_loterie WHERE id = :id");
        $stmt->bindParam(':id', $gainLoterieId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $quantite = $result['quantite_totale'] - 1; // Décrémente la quantité de 1
        M_Loterie::mettreAJourQuantiteLot($gainLoterieId, $quantite);
    }
}
