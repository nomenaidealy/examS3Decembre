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
        $sql = "
            SELECT v.id, v.numero_immatriculation
            FROM vehicules v
            WHERE v.id NOT IN (
                SELECT vp.idVehicule
                FROM vehicule_panne vp
                WHERE vp.dateDebut <= :date
                  AND (vp.dateFin IS NULL OR vp.dateFin >= :date)
            )
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':date', $date);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
