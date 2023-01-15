<?php
require_once 'vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;

use \Bramus\Router\Router;
use Controller\UserController;
use Controller\CurrencyController;
use DB\DB;
session_start();

$router = new Router();
$db = new DB();

$router->get('/home', function () {
    if (!$_SESSION['auth']) {
        header('Location:/');
    } else {
        require_once 'src/view/home.php';
    }
});

$router->get('/', function () {
    require_once 'src/view/start_page.php';
});

$router->post('/createUser', function () use ($db) {
    $controller = new UserController($_POST,$db);
    $controller->registration();
});

$router->post('/auth', function () use ($db) {
    $controller = new UserController($_POST,$db);
    $controller->auth();
});

$router->post('/convert', function () use($db) {
    $controller = new CurrencyController($_POST,$db);
    $controller->getConverted();
});

$router->run();


?>


