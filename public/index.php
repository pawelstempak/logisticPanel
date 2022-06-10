<?php
/* public/index.php */

// echo "<pre>";
// var_dump($params);
// echo "</pre>";

use Dotenv\Dotenv;
use app\core\Application;
use app\controllers\SearchController;
use app\controllers\AuthController;
use app\controllers\SendersController;
use app\controllers\TrackingController;

require_once __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../config/setup.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$app = new Application(dirname(__DIR__)); 
if($app->isAuth())
{
    $app->router->get('/', [SearchController::class, 'searchForm']);
    $app->router->post('/', [SearchController::class, 'searchForm']);
    $app->router->get('/trackinglist', [TrackingController::class, 'trackinglist']);
    $app->router->post('/trackinglist', [TrackingController::class, 'trackinglist']);
    $app->router->get('/deletetracking', [TrackingController::class, 'deletetracking']);
    $app->router->get('/newtracking', [TrackingController::class, 'newtracking']);
    $app->router->post('/newtracking', [TrackingController::class, 'newtracking']);
    $app->router->get('/senderslist', [SendersController::class, 'sendersList']);
    $app->router->get('/newsender', [SendersController::class, 'newSender']);
    $app->router->post('/newsender', [SendersController::class, 'newSender']);    
    $app->router->get('/logout', [AuthController::class, 'logout']);    
}
else
{
    $app->router->get('/', [AuthController::class, 'login']);
    $app->router->post('/', [AuthController::class, 'login']);
}
$app->run();
