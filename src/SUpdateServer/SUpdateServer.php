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

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Silex\Application;
use \Symfony\Component\HttpFoundation\Request;

/**
 * The S-Update-Server main class
 *
 * @package \SUpdateServer
 * @version 3-(Base-2.0.0-BETA)
 */
class SUpdateServer extends Application {

    /**
     * The entier server version
     */
    const SERVER_VERSION = "3.1.0-BETA";

    /**
     * The server base version
     */
    const BASE_VERSION = "2.0.0";

    /**
     * The server panel version
     */
    const PANEL_VERSION = "1.0.1";

    /**
     * The server internal version
     */
    const INTERNAL_VERSION = "2.0.0";

    /**
     * The main application instance
     */
    private static $instance;

    /**
     * The application config
     */
    private static $appConfig;

    /**
     * The server config
     */
    private static $serverConfig;

    /**
     * The directory where are the files
     */
    const FILES_DIRECTORY = "files";

    /**
     * Return the main application instance
     *
     * @return SUpdateServer The SUpdateServer main instance
     */
    public static function app() {
        if(self::$instance == null)
            self::$instance = new SUpdateServer();
        return self::$instance;
    }

    /**
     * Return the app config
     *
     * @return Config The app config
     */
    public static function config() {
        if(self::$appConfig == null)
            self::$appConfig = new Config("app");

        return self::$appConfig;
    }

    /**
     * Return the server config
     *
     * @return Config The server config
     */
    public static function serverConfig() {
        if(self::$serverConfig == null)
            self::$serverConfig = new Config("server");

        return self::$serverConfig;
    }

    /**
     * Handle an error
     *
     * @param \Exception $e
     *            The error to handle
     * @param int $code
     *            The code of the error
     *
     * @return The response
     */
    public function handleError(\Exception $e, $code)
    {
        if ($code == 404) {
            $title = "404 !";
            $message = "Sorry ! Can't find the requested page !";
        } else if ($code == 405) {
            $title = "Method not allowed !";
            $message = "Sorry, you can't access this page by this way !";
        } else {
            $title = "Unknown error, code : " . $code;
            $message = $e->getMessage();
        }

        return $this['twig']->render('error.twig', array('title' => $title, 'message' => $message));
    }

    /**
     * Return the install middleware
     *
     * @return Closure The install middleware
     */
    public static function installMiddleware() {
        return function (Request $request, Application $app) {
            $isInstallPage = $request->get("_route") == "GET_install" || $request->get("_route") == "POST_install";
            $isServerInstalled = file_exists("config/server.json");

            if($isInstallPage)
                if($isServerInstalled)
                    return new RedirectResponse("panel");
                else
                    return;
            else
                if($isServerInstalled)
                    return;
                else
                    return new RedirectResponse("../install");

        };
    }

    /**
     * Return the auth middleware
     *
     * @return Closure The auth middleware
     */
    public static function authMiddleware() {
        return function (Request $request, Application $app) {
            $isLoginPage = $request->get("_route") == "GET_auth_login" || $request->get("_route") == "POST_auth_login";
            $isUserLogged = isset($_SESSION["logged"]) && $_SESSION["logged"] == true;

            if ($_SERVER["REQUEST_METHOD"] == "POST" && !$isUserLogged && !$isLoginPage) {
                $response = new Response("Forbidden");
                $response->setStatusCode(403);

                return $response;
            }

            if($isLoginPage)
                if($isUserLogged)
                    return new RedirectResponse("panel");
                else
                    return;
            else
                if($isUserLogged)
                    return;
                else
                    return new RedirectResponse(file_exists("config/server.json") ? "../auth/login" : "auth/login");
        };
    }

    /**
     * Display a view
     */
    public function display($view, $args = array()) {
        return $this["twig"]->render($view, $args);
    }

}

?>
