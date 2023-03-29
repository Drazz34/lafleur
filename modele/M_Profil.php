<?php

class M_Profil
{

    // Récupération des informations de l'adresse du client
    public static function adresseClient($idClient)
    {
        $pdo = Accesdonnees::getPdo();
        $stmt = $pdo->prepare('SELECT lf_adresses.rue, lf_codes_postaux.code_postal, lf_villes.nom_ville
    FROM lf_adresses
    JOIN lf_adresse_client ON lf_adresses.id = lf_adresse_client.adresse_id
    JOIN lf_codes_postaux ON lf_codes_postaux.id = lf_adresses.code_postal_id
    JOIN lf_villes ON lf_villes.id = lf_adresses.ville_id
    WHERE lf_adresse_client.client_id = :client_id');
        $stmt->bindParam(':client_id', $idClient);
        $stmt->execute();
        $adresse = $stmt->fetch(PDO::FETCH_ASSOC);
        return $adresse;
    }


    /**
     * Met à jour un client avec une nouvelle adresse associée.
     *
     * @param int $idClient L'ID du client à mettre à jour.
     * @param string $email Le nouvel e-mail du client.
     * @param string $password Le nouveau mot de passe du client.
     * @param string $nom Le nouveau nom du client.
     * @param string $prenom Le nouveau prénom du client.
     * @param string $rue La nouvelle rue de l'adresse du client.
     * @param string $cp Le nouveau code postal de l'adresse du client.
     * @param string $ville Le nouveau nom de la ville de l'adresse du client.
     */
    public static function mettreAJourClient($idClient, $email, $password, $nom, $prenom, $rue, $cp, $ville)
    {
        // Récupération de l'objet PDO pour effectuer des requêtes SQL
        $pdo = AccesDonnees::getPdo();

        // Hashage du mot de passe du client
        if ($password) {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare('UPDATE lf_clients SET email = :email, mot_de_passe = :password, nom = :nom, prenom = :prenom WHERE id = :idClient');
            $stmt->bindParam(':password', $password);
        } else {
            $stmt = $pdo->prepare('UPDATE lf_clients SET email = :email, nom = :nom, prenom = :prenom WHERE id = :idClient');
        }
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':idClient', $idClient);
        $stmt->execute();

        // Mettre à jour l'adresse du client dans la base de données
        $stmt = $pdo->prepare('UPDATE lf_adresses SET rue = :rue, code_postal_id = :cp_id, ville_id = :ville_id WHERE id = :adresse_id');
        $stmt->bindParam(':rue', $rue);

        // Recherche de l'ID du code postal correspondant dans la table lf_codes_postaux
        $stmt_cp = $pdo->prepare('SELECT id FROM lf_codes_postaux WHERE code_postal = :cp');
        $stmt_cp->bindParam(':cp', $cp);
        $stmt_cp->execute();
        $cp_id = $stmt_cp->fetchColumn();

        // Si le code postal n'existe pas encore dans la base de données, on l'ajoute
        if (!$cp_id) {
            $stmt_ajout_cp = $pdo->prepare('INSERT INTO lf_codes_postaux(code_postal) VALUES (:cp)');
            $stmt_ajout_cp->bindParam(':cp', $cp);
            $stmt_ajout_cp->execute();

            // On récupère l'ID du code postal nouvellement créé
            $cp_id = $pdo->lastInsertId();
        }

        $stmt->bindParam(':cp_id', $cp_id);

        // Recherche de l'ID de la ville correspondante dans la table lf_villes
        $stmt_ville = $pdo->prepare('SELECT id FROM lf_villes WHERE nom_ville = :ville');
        $stmt_ville->bindParam(':ville', $ville);
        $stmt_ville->execute();
        $ville_info = $stmt_ville->fetch();
        if ($ville_info !== false) {
            $ville_id = $ville_info['id'];
        } else {
            // Gérer le cas où la requête ne retourne aucun résultat (ville non trouvée)
            $ville_id = null;
        }

        // Si la ville n'existe pas encore dans la base de données, on l'ajoute
        if (!$ville_id) {
            $stmt_ajout_ville = $pdo->prepare('INSERT INTO lf_villes(nom_ville, livrable) VALUES (:ville, :livrable)');
            $stmt_ajout_ville->bindParam(':ville', $ville);
            $stmt_ajout_ville->bindValue(':livrable', 0); // La ville sera par défaut non livrable
            $stmt_ajout_ville->execute();

            // On récupère l'ID de la ville nouvellement créée
            $ville_id = $pdo->lastInsertId();
        }

        $stmt_adresse = $pdo->prepare('SELECT adresse_id FROM lf_adresse_client WHERE client_id = :client_id');
        $stmt_adresse->bindParam(':client_id', $idClient);
        $stmt_adresse->execute();
        $adresse_id = $stmt_adresse->fetchColumn();

        $stmt = $pdo->prepare('UPDATE lf_adresses SET rue = :rue, code_postal_id = :cp_id, ville_id = :ville_id WHERE id = :adresse_id');
        $stmt->bindParam(':rue', $rue);
        $stmt->bindParam(':cp_id', $cp_id);
        $stmt->bindParam(':ville_id', $ville_id);
        $stmt->bindParam(':adresse_id', $adresse_id);
        $stmt->execute();

        $stmt = $pdo->prepare('UPDATE lf_clients SET email = :email, mot_de_passe = :password, nom = :nom, prenom = :prenom WHERE id = :client_id');
        $stmt->bindParam(':email', $nouvel_email);
        $stmt->bindParam(':password', $nouveau_password);
        $stmt->bindParam(':nom', $nouveau_nom);
        $stmt->bindParam(':prenom', $nouveau_prenom);
        $stmt->bindParam(':client_id', $client_id);
        $stmt->execute();
    }
}
