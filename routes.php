<?php
$controllers = array(
    'home' => ['home'],
    'profile' => ['profile'],
    'generate' => ['generate'],
);

if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
  $controller = 'home';
}

include_once('controller/' . $controller . '.php');
$klass = ucwords($controller) . 'Controller';
$controller = new $klass;
$controller->$action();
