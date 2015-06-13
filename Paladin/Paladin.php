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
 * The Paladin Main Class
 *
 * @author TheShark34
 * @package Paladin
 * @version 1.0.0-BETA
 */
class Paladin {

  /**
   * The folder where Paladin was installed
   */
  private static $rootFolder;
  
  /**
   * The current Twig Environment
   */
  private static $twig;
  
  /**
   * The current RouteLoader
   */
  private static $routeLoader;
  
  /**
   * The current PageLoader
   */
  private static $pageLoader;
  
  /**
   * The current ThemeLoader
   */
  private static $themeLoader;
  
  /**
   * If Twig should always update the cache (by default false)
   */
  private static $autoreload = false;

  /**
   * Returns the root folder (where Paladin was installed)
   *
   * @return The root folder
   */
  public static function getRootFolder() {
    if(!isset(self::$rootFolder))
      self::$rootFolder = "/" . str_replace($_SERVER['DOCUMENT_ROOT'], "", dirname($_SERVER['SCRIPT_FILENAME'])) . "/";
    
    return self::$rootFolder;
  }

  /**
   * Loads Twig
   */
  public static function loadTwig() {
    // Creating a Twig Loader for the current folder
    $loader = new \Twig_Loader_Filesystem("./");
    
    // Creating a twig environment with the Cache folder as the compilation cache
    self::$twig = new \Twig_Environment($loader, array(
        'cache' => 'Paladin/Cache/',
        'auto_reload' => self::$autoreload
    ));
    
    // Adding it the extension
    self::$twig->addExtension(new PaladinTwigExtension());
  }

  /**
   * Sets auto reload enabled, or not (by default false) (usefull for developping)
   *
   * @param $autoreload
   *            If auto reload should be enabled
   */
  public static function setAutoreloadEnabled($autoreload) {
    self::$autoreload = $autoreload;
  }

  /**
   * Returns if the auto reload is enabled (by default false)
   *
   * @return If auto reload is enabled
   */
  public static function isAutoreloadEnabled() {
    return self::$autoreload;
  }

  /**
   * Returns the current Twig Environment
   *
   * @return The Twig Environment
   */
  public static function getTwig() {
    // If Twig isn't initialized
    if(!isset(self::$twig))
      // Loading it
      self::loadTwig();
      
    return self::$twig;
  }

  /**
   * Print an error if we can't find the ErrorPage
   *
   * @param $message
   *            The error message
   * @param $header
   *            The header to set
   * @param $fatal
   *            If the error is fatal
   */
  public static function printError($message, $header, $fatal) {
    // Setting the header
    header($header);
    
    // Printing the error
    echo "<h1>Paladin" . ($fatal ? " Fatal" : "") . " Error</h1><p>" . $message . "</p>";
    
    // If it is fatal, stopping all
    if($fatal)
      die();
  }
  
  /**
   * Returns the current page loader (and creates it if it doesn't exist)
   *
   * @return The page loader
   */
  public static function getPageLoader() {
    if(!isset(self::$pageLoader))
      self::$pageLoader = new PageLoader("Pages");

    return self::$pageLoader;
  }
  
  /**
   * Returns the current route loader (and creates it if it doesn't exist)
   *
   * @return The route loader
   */
  public static function getRouteLoader() {
    if(!isset(self::$routeLoader))
      self::$routeLoader = new RouteLoader("Routes");

    return self::$routeLoader;
  }

  /**
   * Returns the current theme loader (and creates it if it doesn't exist)
   *
   * @return The theme loader
   */
  public static function getThemeLoader() {
    if(!isset(self::$themeLoader))
      self::$themeLoader = new ThemeLoader("Themes");

    return self::$themeLoader;
  }

}
