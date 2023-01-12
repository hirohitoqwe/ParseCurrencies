<?php
require_once 'vendor/autoload.php';

use \Bramus\Router\Router;
use Controller\UserController;


session_start();
$router = new Router();

$router->get('/', function () {
    require_once 'src/view/start_page.php';
    die();
});

$router->get('/home', function () {
    require_once 'src/view/home.php';
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

?>


