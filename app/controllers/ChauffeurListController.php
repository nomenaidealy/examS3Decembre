<?php

namespace app\controllers;

use flight\Engine;
use app\models\ChauffeurList; // changed import

class ChauffeurListController {
        
    protected Engine $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function getList () {
        $db = $this->app->db();
        $chaList = new ChauffeurList($db); // changed class name here
        $data = $chaList->getList();

        return $data;
    }

}