<?php

class M_Client
{

    public static function trouverClientParId($id)
{
    // Récupération de l'objet PDO pour effectuer des requêtes SQL
    $pdo = AccesDonnees::getPdo();

    // Recherche du client dans la base de données
    $stmt = $pdo->prepare('SELECT * FROM lf_clients WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    return $client;
}

public static function trouverClientParEmail($email)
{
    // Récupération de l'objet PDO pour effectuer des requêtes SQL
    $pdo = AccesDonnees::getPdo();

    // Recherche du client dans la base de données
    $stmt = $pdo->prepare('SELECT * FROM lf_clients WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    return $client;
}

    /**
     * Permet à un client inscrit de se connecter
     * 
     * @param string $email
     * @param string $password
     */
    public static function trouverClientParEmailEtMDP($email, $password)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM lf_clients WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $client = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($client && password_verify($password, $client["mot_de_passe"])) {
            return $client;
        }
        return false;
    }

    

    /**
     * Crée un nouveau client avec une adresse associée.
     *
     * @param string $email L'adresse e-mail du client.
     * @param string $password Le mot de passe du client.
     * @param string $nom Le nom du client.
     * @param string $prenom Le prénom du client.
     * @param string $rue La rue de l'adresse du client.
     * @param string $cp Le code postal de l'adresse du client.
     * @param string $ville Le nom de la ville de l'adresse du client.
     */
    public static function creerClient($email, $password, $nom, $prenom, $rue, $cp, $ville)
    {


        // Récupération de l'objet PDO pour effectuer des requêtes SQL
        $pdo = AccesDonnees::getPdo();

        // Hashage du mot de passe du client
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Insertion du client dans la table lf_clients
        $stmt = $pdo->prepare('INSERT INTO lf_clients(email, mot_de_passe, nom, prenom) VALUES (:email, :password, :nom, :prenom)');
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->execute();

        // Récupération de l'ID du client nouvellement créé
        $client_id = $pdo->lastInsertId();

        // Insertion de l'adresse du client dans la table lf_adresses
        $stmt = $pdo->prepare('INSERT INTO lf_adresses(rue, code_postal_id, ville_id) VALUES (:rue, :cp_id, :ville_id)');
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

        $stmt->bindParam(':ville_id', $ville_id);
        $stmt->execute();

        // Récupération de l'ID de l'adresse nouvellement créée
        $adresse_id = $pdo->lastInsertId();

        // Insertion de la relation many-to-many entre le client et l'adresse dans la table lf_adresse_client
        $stmt = $pdo->prepare('INSERT INTO lf_adresse_client(client_id, adresse_id) VALUES (:client_id, :adresse_id)');
        $stmt->bindParam(':client_id', $client_id);
        $stmt->bindParam(':adresse_id', $adresse_id);
        $stmt->execute();
    }
}
