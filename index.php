<?php

/*
* Copyright 2015 TheShark34
*
* This file is part of S-Update-Server.

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

if(!is_dir(__DIR__ . "/vendor")) {
    echo 'Il faut telecharger le serveur depuis la page release ici : https://github.com/TheShark34/S-Update-Server/releases';
    die();
}

if(!file_exists(__DIR__ . "/files"))
    mkdir(__DIR__ . "/files");

// Starting the error handler
require 'S-Update-Server/SUErrorHandler.php';
\SUpdateServer\SUErrorHandler::init();

// Loading Paladin
require 'vendor/autoload.php';
require 'Paladin/Page.php';
require 'Paladin/PageLoader.php';
require 'Paladin/Paladin.php';
require 'Paladin/PaladinTwigExtension.php';
require 'Paladin/Route.php';
require 'Paladin/RouteLoader.php';
require 'Paladin/ThemeLoader.php';

// Loading S-Update-Server
require 'S-Update-Server/LangLoader/LangLoader.php';
require 'S-Update-Server/LangLoader/LangLoaderTwigExtension.php';
require 'S-Update-Server/SUpdateServerTwigExtension.php';
require 'S-Update-Server/ServerState.php';
require 'S-Update-Server/AppLoader/AppLoader.php';
require 'S-Update-Server/AppLoader/Application.php';
require 'S-Update-Server/Checking/CheckMethodLoader.php';
require 'S-Update-Server/Checking/CheckMethod.php';
require 'S-Update-Server/SessionManager.php';
require 'S-Update-Server/Dashboard/DashboardManager.php';
require 'S-Update-Server/Dashboard/DashboardEntry.php';
require 'S-Update-Server/Dashboard/FileExplorerDBEntry.php';
require 'S-Update-Server/Dashboard/StatsDBEntry.php';
require 'S-Update-Server/StatsManager.php';


// TODO: Remove this line, only for dev
Paladin\Paladin::setAutoreloadEnabled(true);

// Starting the session manager
SUpdateServer\SessionManager::create();

// Starting LangLoader
SUpdateServer\LangLoader\LangLoader::create();

// Adding the LangLoader Twig Extension to Twig
Paladin\Paladin::getTwig()->addExtension(new SUpdateServer\LangLoader\LangLoaderTwigExtension());

// Adding the SUpdate Twig Extension to Twig
Paladin\Paladin::getTwig()->addExtension(new SUpdateServer\SUpdateServerTwigExtension());

// Loading the applications
SUpdateServer\AppLoader\AppLoader::create();

// Loading the check methods
SUpdateServer\Checking\CheckMethodLoader::create();

// Adding the dashboard entries
SUpdateServer\Dashboard\DashboardManager::addSUEntries();

// Loading the statistics
SUpdateServer\StatsManager::loadStats();

// Loading the session
SUpdateServer\SessionManager::getSessionManager()->start();

?>
