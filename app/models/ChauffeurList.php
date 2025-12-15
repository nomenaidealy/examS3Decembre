<?php

namespace app\models;

class ChauffeurList { // changed class name
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function getList () {   
        $stmt = $this->db->prepare("SELECT * FROM vueListeChauffeurVehicule");
        $stmt->execute();
        $produits = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $produits;
    }

}