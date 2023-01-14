<?php
require_once 'vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;

/*
use \Bramus\Router\Router;
use Controller\UserController;


session_start();

$router = new Router();

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

$router->post('/createUser', function () {
    $controller = new UserController($_POST);
    $controller->registration();
});

$router->post('/auth', function () {
    $controller = new UserController($_POST);
    $controller->auth();
});


$router->run();
*/

$source = new \Components\SourceData();

$db= new \DB\DB();

$db->insertCurrencies($source->getCurrenciesData());

?>


