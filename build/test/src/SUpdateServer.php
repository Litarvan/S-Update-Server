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

namespace SUpdateServer;
use Paladin\ErrorHandling\PaladinErrorHandler;
use Paladin\Paladin;
use SUpdateServer\Application\AppLoader;
use SUpdateServer\CheckMethod\CheckMethodLoader;

/**
 * The S-Update-Server main class
 *
 * @author  Litarvan
 * @version 3-(Base-3.0.0-BETA)
 */
class SUpdateServer
{
    /**
     * The entire server version
     */
    const SERVER_VERSION = "3.2.0-BETA";

    /**
     * The server base version
     */
    const BASE_VERSION = "3.0.0";

    /**
     * The server panel version
     */
    const PANEL_VERSION = "1.0.2";

    /**
     * The server internal version
     */
    const INTERNAL_VERSION = "2.1.0";

    /**
     * The main application instance
     */
    private static $instance;

    /**
     * The directory where are the files
     */
    const FILES_DIRECTORY = "files";

    /**
     * Return the main application instance
     *
     * @return SUpdateServer The SUpdateServer main instance
     */
    public static function get()
    {
        if (self::$instance == null)
            self::$instance = new SUpdateServer();

        return self::$instance;
    }

    /**
     * Start the server
     */
    public static function start()
    {
        // Initializing session
        session_start();

        // Setting up error handling
        PaladinErrorHandler::setErrorPageLocation("views/ErrorPage.html");

        // Setting up debug if needed
        if (Paladin::config("app")->get("debug"))
        {
            $engine = Paladin::getViewingEngineManager()->getSelectedEngine();

            if (get_class($engine) == 'Paladin\Viewing\TwigViewingEngine')
            {
                $engine->getTwig()->enableAutoReload();
                $engine->getTwig()->enableDebug();
            }
        }

        // Initializing
        CheckMethodLoader::create();
        AppLoader::create();

        // Creating files folder if needed
        if (!file_exists("files/"))
            mkdir("files/");
    }
}