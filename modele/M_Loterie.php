<?php

class M_Loterie
{
    // public static function afficheGains()
    // {
    //     $pdo = AccesDonnees::getPdo();
    //     $stmt = $pdo->prepare("SELECT * FROM lf_gains_loterie");
    //     $stmt->execute();
    //     $gains = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     return $gains;
    // }

    // public static function recupererGainLoterieId($lot)
    // {
    //     $pdo = AccesDonnees::getPdo();
    //     $stmt = $pdo->prepare("SELECT id FROM lf_gains_loterie WHERE lot = :lot");
    //     $stmt->bindParam(':lot', $lot, PDO::PARAM_STR);
    //     $stmt->execute();
    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //     return $result ? $result['id'] : null;
    // }

    public static function mettreAJourQuantiteLot($idLot, $quantite)
    {
        $pdo = Accesdonnees::getPdo();
        $stmt = $pdo->prepare("UPDATE lf_gains_loterie SET quantite_totale = :quantite WHERE id = :id");
        $stmt->bindParam(':id', $idLot, PDO::PARAM_INT);
        $stmt->bindParam(':quantite', $quantite, PDO::PARAM_INT);
        $stmt->execute();
    }
}
