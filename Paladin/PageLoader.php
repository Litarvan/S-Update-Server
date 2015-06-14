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
 * The Pages system
 *
 * @author TheShark34
 * @package Paladin
 * @version 1.0.0-BETA
 */
class PageLoader {

  /**
   * The emergency message when a 404 error was throwed but it can't find the ErrorPage, or it contains an error
   */
  public static $EMERGENCY_PAGE_MAIN_CLASS_NOT_FOUND_ERROR = "A 'Page main class not found' error was throwed, but the ErrorPage doesn't exist or contain an error.";

  /**
   * The emergency message when a page doesn't extends the Page class but it can't find the ErrorPage, or it contains an error
   */
  public static $EMERGENCY_PAGE_NOT_PAGE_ERROR = "A 'Page doesn't extends the Page class' error was throwed, but the ErrorPage doesn't exist or contain an error.";

  /**
   * The folder containing the pages
   */
  private $folder;

  /**
   * Init the PageLoader with a folder, containing the pages
   */
  public function __construct($folder) {
    $this->folder = $folder;
  }

  /**
   * Display a page
   *
   * @param $namespace
   *            The namespace of the page class
   * @param $page
   *            The page folder relative path
   * @param $args
   *            The arguments to give to the constructTwigArray method of the page
   */
  public function displayPage($namespace, $page, $args) {
    // Getting the name of the main page class by taking the last folder name
    $mainPage = basename($this->folder . "/" . $page);

    // Checking if the page exists
    if(!$this->checkPage($page, $namespace, $mainPage))
      return;

    // Getting the page path
    $pagePath = $this->folder . "/" . $page . "/" . $mainPage . ".php";

    // Including it
    require_once $pagePath;

    // Getting the page full name
    $pagePath = $namespace . "\\" . $mainPage;

    // Initializing the page main class
    $pageInstance = new $pagePath;

    // If it isn't an instance of Page
    if(!($pageInstance instanceof Page)) {
      // If the page isn't the error page
      if(!($page == "ErrorPage" && $namespace == "\Paladin\Pages"))
        // Displaying an error page
        self::displayPage("\Paladin\Pages", "ErrorPage", array("Page PHP dev error", "Sorry ! The website developper made a mistake !</br>The page " . $pagePath . " need to extends Paladin\Page."));

      // Else if it's the error page
      else
        // Printing an emergency 'Page not Page' error
        Paladin::printError(self::$EMERGENCY_PAGE_NOT_PAGE_ERROR, "HTTP/1.0 500 Internal Server Error", true);

      // Stopping the method
      return;
    }

    // Rendering the page
    $this->renderPage($pageInstance, $args);
  }

  /**
   * Checks if a page main class exists
   *
   * @param page
   *           The page relative path
   * @param namespace
   *           The namespace of the page main class
   * @param mainPage
   *           The main page name
   * @return True if it exists, false if not
   */
  private function checkPage($page, $namespace, $mainPage) {
    // Getting the full path of the page
    $pagePath = $this->folder . "/" . $page . "/" . $mainPage . ".php";

    // If it doesn't exist
    if(!file_exists($pagePath)) {
      // If the page isn't the error page
      if(!($page == "ErrorPage" && $namespace == "\Paladin\Pages"))
        // Displaying an error page
        self::displayPage("\Paladin\Pages", "ErrorPage", array("Page mistake", "Sorry ! You tried to display a page but we can't find its main class (" . $pagePath . ") !"));

      // Else if it's the error page
      else
        // Printing an emergency 'Page main class not found' error
        Paladin::printError(self::$EMERGENCY_PAGE_MAIN_CLASS_NOT_FOUND_ERROR, "HTTP/1.0 500 Internal Server Error", true);

      // Returning false
      return false;
    }

    // Returning true
    return true;
  }

  /**
   * Renders a page
   *
   * @param page
   *           The page relative path
   * @param pageInstance
   *           The page main class instance
   * @param args
   *           The arguments of the page
   */
  private function renderPage($pageInstance, $args) {
    // Sending the 'beforeDisplayed()' event to the page
    $pageInstance->beforeDisplayed();
    
    // Creating the template path
    $templatePath = "/" . $pageInstance->getName() . "/" . $pageInstance->getMainPage();
    
    // If the page instance is themable and the current theme contains the page
    if($pageInstance->isThemable() && file_exists(Paladin::getThemeLoader()->getFolder() . "/" . Paladin::getThemeLoader()->getCurrentTheme() . $templatePath))
      // Setting the template path to the theme template path
      $templatePath = Paladin::getThemeLoader()->getFolder() . "/" . Paladin::getThemeLoader()->getCurrentTheme() . $templatePath;
    else
      // Setting the template path to the default path
      $templatePath = $this->folder . $templatePath;

    // If the template doesn't exist
    if(!file_exists($templatePath)) {
      // Displaying an error page
      self::displayPage("\Paladin\Pages", "ErrorPage", array("Page mistake", "Sorry ! We can't find the twig template for the page : " . $pageInstance->getName() . " !"));
    
      // Stopping
      return;
    }

    // Rendering the page with Twig
    echo Paladin::getTwig()->render($templatePath, $pageInstance->constructTwigArray($args));

    // Sending the 'afterDisplayed()' event to the page
    $pageInstance->afterDisplayed();
  }

  /**
   * Returns the current page folder
   *
   * @return The current folder
   */
  public function getFolder() {
    return $this->folder;
  }

}

?>
