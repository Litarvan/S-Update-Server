<?php

/*
 * Copyright 2015 TheShark34
 *
 * This file is part of Paladin.
 *
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

namespace Paladin;

/**
 * The Routes system
 *
 * @author TheShark34
 * @package Paladin
 * @version 1.0.0-BETA
 */
class RouteLoader {

    /**
     * The folders where Routes are
     */
    private $folders;

    public function __construct($folder) {
        $this->folders[0] = $folder;
    }

    /**
     * Returns the route of the current URL as an array
     *
     * With an url like this : http://foo.bar/hi/i/am/an/url
     * The name is hi
     * And the arguments are i, am, an, and url
     *
     * @return An array with 'name' as the name of the route and 'args' as another array with the arguments
     */
    public function getCurrentRoute() {
        // Just returning getCurrentRouteFromURL with the REQUEST_URI field
        return $this->getCurrentRouteFromURL($_SERVER['REQUEST_URI']);
    }

    /**
     * Returns the route of an URL as an array
     *
     * With an url like this : http://foo.bar/hi/i/am/an/url
     * The name is hi
     * And the arguments are i, am, an, and url
     *
     * @return An array with 'name' as the name of the route and 'args' as another array with the arguments
     */
    public function getCurrentRouteFromURL($url) {
        // Trimming the URL with s/
        $completeRoute = trim($_SERVER['REQUEST_URI'], '/');

        // If the trimmed url starts with / but the script name not
        if(substr($completeRoute, 0, 1) == "/" && substr($_SERVER['SCRIPT_NAME'], 0, 1) != "/")
            // Deleting the / in the start of the url
            $completeRoute = $substr($completeRoute, 1);

        // Else if the url doesn't start with / but the script name do
        else if(substr($completeRoute, 0, 1) != "/" && substr($_SERVER['SCRIPT_NAME'], 0, 1) == "/")
            // Adding / to the url
            $completeRoute = "/" . $completeRoute;

        // Deleting the current script parent folder of the url
        $completeRoute = str_replace(dirname($_SERVER['SCRIPT_NAME']), "", $completeRoute);

        // If the url starts with /
        if(substr($completeRoute, 0, 1) == "/")
            // Deleting it
            $completeRoute = substr($completeRoute, 1);

        // The splitting the url with /
        $splittedURL = explode("/", $completeRoute);

        // The route name is the first index
        $route['name'] = $splittedURL[0];

        // And adding the others to the args array
        for ($i = 1; $i < sizeof($splittedURL); $i++)
            $route['args'][$i - 1] = $splittedURL[$i];

        // Adding a blank args array if there aren't arguments
        if(!isset($route['args']))
            $route['args'] = array();

        // Returning the created array
        return $route;
    }

    /**
     * Load route from the current URL
     */
    public function loadRoute() {
        // Just loading the route from the REQUEST_URI
        $this->loadRouteFromURL($_SERVER['REQUEST_URI']);
    }

    /**
     * Load route from the given URL
     */
    public function loadRouteFromURL($url) {
        // Getting the route name and arguments for the given URL
        $route = $this->getCurrentRouteFromURL($url);

        // If there isn't name
        if($route['name'] == "")
        // Setting the route name as 'index'
        $route['name'] = "Index";

        for($i = 0; $i < sizeof($this->folders); $i++) {
            // Getting the route path
            $routePath = $this->folders[$i] . "/" . $route['name'] . ".php";

            // If the route directory doesn't exist
            if(!file_exists($routePath)) {
                // If this is the last folder of the list
                if($i == sizeof($this->folders) - 1) {
                    // Displaying the 404 page
                    Paladin::getPageLoader()->displayPage("\Paladin\Pages", "ErrorPage", array("404 :(", "Sorry ! The page you requested cannot be found !"));

                    // Stopping the function
                    return;
                } else
                    // Continuing the loop
                    continue;
            }

            // Else if it exists
            else
                // Breaking the loop
                break;
        }

        // Calling the route
        require $routePath;
        $routeClass = new $route['name'];
        $routeClass->onCalling($route['args']);
    }

    /**
     * Returns the current routes folders
     *
     * @return The current folders
     */
    public function getFolders() {
        return $this->folders;
    }

    /**
     * Adds a folder to the Routes folders list
     *
     * @param folder
     *            The new route folder
     */
    public function addFolder($folder) {
        $this->folders[sizeof($this->folders)] = $folder;
    }

}


?>
