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

    public static function recupererGainLoterieId($lot)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT id FROM lf_gains_loterie WHERE lot = :lot");
        $stmt->bindParam(':lot', $lot, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['id'] : null;
    }
    
}