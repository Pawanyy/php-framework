<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
use app\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', 'home');

$app->router->get('/home', 'home');

$app->router->get('/contact', 'contact');

$app->router->post('/contacta', function(){
    //TODO: Add Site Controllers To handle operation
});

$app->run();