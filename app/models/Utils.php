<?php

namespace app\models;

class Utils { // changed class name
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function getBeneficeParVehicule () {   
        $stmt = $this->db->prepare("SELECT * FROM vue_benefice_vehicule");
        $stmt->execute();
        $produits = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $produits;
    }

}