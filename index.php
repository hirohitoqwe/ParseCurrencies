<?php
require_once 'vendor/autoload.php';

use \Bramus\Router\Router;

session_start();
$router = new Router();

$router->get('home', function () {
    echo '123';
});

$router->post('/createUser', function () {
    $controller = new UserController($_POST);
    $controller->index();
});

$router->post('/auth', function () {

});

$router->get('/', function () {
    require_once 'src/view/start_page.php';
});

$router->run();

?>


