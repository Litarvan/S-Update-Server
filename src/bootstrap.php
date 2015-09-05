<?php

/*
 * Copyright 2015 TheShark34
 *
 * This file is part of S-Update-Server.
 *
 * S-Update-Server is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * S-Update-Server is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with S-Update-Server.  If not, see <http://www.gnu.org/licenses/>.
 */

// Starting the session
session_start();

// Loading the classes
require_once "SUpdateServer/SUpdateServer.php";
require_once "SUpdateServer/Config.php";
require_once "SUpdateServer/PanelController.php";
require_once "SUpdateServer/ServerController.php";
require_once "SUpdateServer/AuthController.php";
require_once "SUpdateServer/StatsController.php";
require_once "SUpdateServer/InstallController.php";
require_once "SUpdateServer/Internal/CheckMethod.php";
require_once "SUpdateServer/Internal/CheckMethodLoader.php";
require_once "SUpdateServer/Internal/Application.php";
require_once "SUpdateServer/Internal/AppLoader.php";

// Loading the routes
$app = SUpdateServer::app();
$routes = require "routes.php";

// Setting debug to the config set
$app['debug'] = SUpdateServer::config()->get("debug");

// Setting the error handler
$app->error(function (\Exception $e, $code) {
    return SUpdateServer::app()->handleError($e, $code);
});

// Loading twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../views',
));

// Registering the service controller service provider
$app->register(new Silex\Provider\ServiceControllerServiceProvider());

// Registering the server controller
$app['server'] = $app->share(function() {
    return new ServerController;
});

// Registering the panel controller
$app['panel'] = $app->share(function() {
    return new PanelController;
});

// Registering the auth controller
$app['auth'] = $app->share(function() {
    return new AuthController;
});

// Registering the stats controller
$app['stats'] = $app->share(function() {
    return new StatsController;
});

// Registering the install controller
$app['install'] = $app->share(function() {
    return new InstallController;
});

// Loading the CheckMethod loader
\SUpdateServer\Internal\CheckMethodLoader::create();

// Loading the Application loader
\SUpdateServer\Internal\AppLoader::create();

// Starting the application
SUpdateServer::app()->run();

?>
