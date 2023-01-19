<?php
require_once 'vendor/autoload.php';

use \Bramus\Router\Router;
use Controller\UserController;
use Controller\CurrencyController;
use DB\DB;

session_start();

$router = new Router();
$db = new DB();

$router->get('/login', function () {
    require_once 'src/view/start_page.php';
});

$router->get('/profile', function () {
    if (!$_SESSION['auth']) {
        header('Location:/login');
    } else {
        require_once 'src/view/profile.php';
    }
});

$router->get('/profile/converter', function () {
    if (!$_SESSION['auth']) {
        header('Location:/');
    } else {
        require_once 'src/view/converter.php';
    }
});

$router->get('/profile/exit', function () {
    if (!$_SESSION['auth']) {
        header('Location:/');
    } else {
        unset($_SESSION['auth']);
        header('Location:/');
    }
});

$router->get('/', function () {
    require_once 'src/view/home.php';
});

$router->post('/createUser', function () use ($db) {
    $controller = new UserController($_POST, $db);
    $controller->registration();
});

$router->post('/auth', function () use ($db) {
    $controller = new UserController($_POST, $db);
    $controller->auth();
});

$router->post('/convert', function () use ($db) {
    $controller = new CurrencyController($_POST, $db);
    echo (json_decode($controller->getConverted()));
});

$router->run();


?>


