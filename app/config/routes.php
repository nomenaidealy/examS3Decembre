<?php

use app\controllers\ApiExampleController;
use app\controllers\ChauffeurListController;
use app\controllers\UtilsController;
use app\controllers\VoitureController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function(Router $router) use ($app) {

	$router->get('/', function() use ($app) {
		$chauffeurListController = new ChauffeurListController($app);
		$chauffeurs = $chauffeurListController->getList();
		$app->render('acceuil', ['data' => $chauffeurs]);
    });

	$router->get('/test', function() use ($app) {
		echo '<h1> Test de routages </h1>';
	});

	$router->get('/hello-world/@name', function($name) {
		echo '<h1>Hello world! Oh hey '.$name.'!</h1>';
	});

	$router->group('/benefice', function() use ($router, $app) {
		$router->get('/vehicule', function() use ($app) {
			$UtilsController = new UtilsController($app);
			$benefice = $UtilsController->getBeneficeParVehicule();
			$app->render('benefice', ['data' => $benefice]);
		});

		$router->get('/jour', function() use ($app) {
			$UtilsController = new UtilsController($app);
			$benefice = $UtilsController->getBeneficeParJour();
			$app->render('beneficeJour', ['data' => $benefice]);
		});
	});
	
	$router->group('/trajet', function() use ($router, $app) {
		$router->get('/rentable', function() use ($app) {
			$UtilsController = new UtilsController($app);
			$trajets = $UtilsController->getTrajetRentable();
			$app->render('trajetRentable', ['data' => $trajets]);
		});
	});

	$router->group('/voitureDispo', function() use ($router, $app) {
		$router->get('/init', function() use ($app) {
			$VoitureController = new VoitureController($app);
			$trajets = $VoitureController->getVehiculeAvailables(null);
			$app->render('voiture', ['data' => $trajets]);
		});
		$router->get('/date/@date', function($date) use ($app) {
			$VoitureController = new VoitureController($app);
			$trajets = $VoitureController->getVehiculeAvailables($date);
			$app->render('voiture', ['data' => $trajets]);
		});
	});


	$router->group('/api', function() use ($router) {
		$router->get('/users', [ ApiExampleController::class, 'getUsers' ]);
		$router->get('/users/@id:[0-9]', [ ApiExampleController::class, 'getUser' ]);
		$router->post('/users/@id:[0-9]', [ ApiExampleController::class, 'updateUser' ]);
	});
	
}, [ SecurityHeadersMiddleware::class ]);