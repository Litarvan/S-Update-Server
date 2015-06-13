<?php

/*
* Copyright 2015 TheShark34
*
* This file is part of Paladin.

* Paladin is free software: you can redistribute it and/or modify
* it under the terms of the GNU Lesser General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* Paladin is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU Lesser General Public License for more details.
*
* You should have received a copy of the GNU Lesser General Public License
* along with Paladin.  If not, see <http://www.gnu.org/licenses/>.
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

// Load the route for the current URL
Paladin\Paladin::getRouteLoader()->loadRoute();

?>
