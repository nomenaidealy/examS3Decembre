<?php

namespace app\controllers;

use flight\Engine;
use app\models\Utils;

class UtilsController {
        
    protected Engine $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function getBeneficeParVehicule () {
        $db = $this->app->db();
        $chaList = new Utils($db);
        $data = $chaList->getBeneficeParVehicule();

        return $data;
    }

}