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
        $data;
        if ($date == null) {
            $data = $chaList->getVehicules();
        } else {
            $data = $chaList->getAvailableCars($date);
        }
        return $data;
    }


}