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

// TODO: Remove this line, only for dev
Paladin\Paladin::setAutoreloadEnabled(true);

// Starting LangLoader
SUpdateServer\LangLoader\LangLoader::create();

// Adding the LangLoader Twig Extension to Twig
Paladin\Paladin::getTwig()->addExtension(new SUpdateServer\LangLoader\LangLoaderTwigExtension());

// Adding the SUpdate Twig Extension to Twig
Paladin\Paladin::getTwig()->addExtension(new SUpdateServer\SUpdateServerTwigExtension());

// Load the route for the current URL
Paladin\Paladin::getRouteLoader()->loadRoute();

?>
