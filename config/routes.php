<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

// Адрес домашней сраницы.
$routes->plugin('Lovesafe', ['path' => '/'], function (RouteBuilder $routes) {
	//$routes->connect('/', ['controller' => 'Pages', 'action' => 'display']);
});

// ../imgs/{url}
$routes->plugin('Lovesafe', ['path' => '/'], function (RouteBuilder $routes) {
    $routes->connect( '/img/{url}', ['controller' => 'Files', 'action' => 'img'] )->setPass(['url']);
});
