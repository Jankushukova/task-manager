

<?php
  require_once '../config/app.php';
  require_once '../vendor/autoload.php';

    $router = new Core\Router();

    // Add the routes
    $router->add('', ['controller' => 'MainController', 'action' => 'index']);
    $router->add('add', ['controller' => 'MainController', 'action' => 'add']);
    $router->add('edit', ['controller' => 'MainController', 'action' => 'edit']);
    $router->add('save', ['controller' => 'MainController', 'action' => 'save']);
    $router->add('dashboard', ['controller' => 'MainController', 'action' => 'dashboard']);
    $router->add('login', ['controller' => 'MainController', 'action' => 'login']);
    $router->add('logout', ['controller' => 'MainController', 'action' => 'logout']);

    $router->dispatch($_SERVER['QUERY_STRING']);

?>

