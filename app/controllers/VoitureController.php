<?php

namespace app\controllers;

use flight\Engine;
use app\models\VoitureModel;

class VoitureController {
        
    protected Engine $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function getVehiculeAvailables ($date) {
        $db = $this->app->db();
        $chaList = new VoitureModel($db);

        // Normaliser la date : trim et valider format YYYY-MM-DD
        if ($date !== null) {
            $date = trim($date);
            $dt = \DateTime::createFromFormat('Y-m-d', $date);
            if ($dt === false) {
                $date = null;
            } else {
                $date = $dt->format('Y-m-d');
            }
        }

        if ($date === null || $date === '') {
            return $chaList->getVehicules();
        }

        return $chaList->getAvailableCars($date);
    }


}