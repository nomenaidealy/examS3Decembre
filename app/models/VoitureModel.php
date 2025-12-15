<?php

namespace app\models;

class VoitureModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }


    public function getVehicules () {   
        $stmt = $this->db->prepare("SELECT * FROM vehicules");
        $stmt->execute();
        $produits = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $produits;
    }

    public function getAvailableCars($date) {
        // date attendu en 'YYYY-MM-DD'
        $sql = "
            SELECT v.id, v.numero_immatriculation
            FROM vehicules v
            WHERE NOT EXISTS (
                SELECT 1
                FROM vehicule_panne vp
                WHERE vp.idVehicule = v.id
                  AND vp.dateDebut <= :date
                  AND (vp.dateFin IS NULL OR vp.dateFin >= :date)
            )
        ";

        $stmt = $this->db->prepare($sql);
        // binder en tant que string; bindValue évite réutilisation de param nommé problématique
        $stmt->bindValue(':date', $date, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}