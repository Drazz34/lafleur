<?php

class M_Loterie
{
    /**
     * Affiche le contenu de la table lf_gains_loterie
     *
     * @return array
     */
    public static function afficheGains()
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM lf_gains_loterie");
        $stmt->execute();
        $gains = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $gains;
    }

    /**
     * Met à jour la quantité du lot remporté
     *
     * @param int $idLot
     * @param int $quantite
     * @return void
     */
    public static function mettreAJourQuantiteLot($idLot, $quantite)
    {
        $pdo = Accesdonnees::getPdo();
        $stmt = $pdo->prepare("UPDATE lf_gains_loterie SET quantite_totale = :quantite WHERE id = :id");
        $stmt->bindParam(':id', $idLot, PDO::PARAM_INT);
        $stmt->bindParam(':quantite', $quantite, PDO::PARAM_INT);
        $stmt->execute();
    }
}
