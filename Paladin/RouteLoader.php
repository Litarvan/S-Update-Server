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

  private $folder;

  public function __construct($folder) {
    $this->folder = $folder;
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
    // Splitting the URL with /
    $splittedURL = explode('/', str_replace(dirname($_SERVER['SCRIPT_FILENAME']) . "/", "", $_SERVER['DOCUMENT_ROOT'].substr($url, 1)));

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
      
    // Getting the route path
    $routePath = $this->folder . "/" . $route['name'] . ".php";
    
    // If the route directory doesn't exist
    if(!file_exists($routePath)) {
      // Displaying the 404 page
      Paladin::getPageLoader()->displayPage("\Paladin\Pages", "ErrorPage", array("404 :(", "Sorry ! The page you requested cannot be found !"));
      
      // Stopping the function
      return;
    }

    // Calling the route
    require $routePath;
    $routeClass = new $route['name'];
    $routeClass->onCalling($route['args']);
  }

  /**
   * Returns the current route folder
   *
   * @return The current folder
   */
  public function getFolder() {
    return $this->folder;
  }

}


?>
