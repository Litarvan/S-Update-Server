<?php

/*
 * Copyright 2015-2016 Adrien Navratil
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

use Paladin\Paladin;
use Paladin\ErrorHandling\PaladinErrorHandler;
use Paladin\Viewing\ViewingEngineManager;

try
{
	Paladin::start(array(
	    "configFolder"      => "config",
	    "sourceFolder"      => "src",
	    "controllerFolder"  => "Controllers",
	    "middlewareFolder"  => "Middlewares",
	    "modelFolder"       => "Models",
	    "resourceFolder"    => "resources",
	    "viewFolder"        => "views",
	    "mainEngine"		=> "twig",
	), function()
	{
        \SUpdateServer\SUpdateServer::start();
	});
}
catch (\Exception $e)
{
	PaladinErrorHandler::displayErrorPage("Exception caught ! " . get_class($e), $e->getMessage(), PaladinErrorHandler::generateBacktrace($e->getTrace()));
}