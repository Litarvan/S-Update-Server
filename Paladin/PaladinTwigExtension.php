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
 * The Paladin Twig Extension
 *
 * @author TheShark34
 * @package Paladin
 * @version 1.0.0-BETA
 */
class PaladinTwigExtension extends \Twig_Extension {
  
  public function getName() {
    return "Paladin Twig Extension";
  }

  public function getFunctions() {
    // Creating the getResource function
    $getResource = new \Twig_SimpleFunction('getResource', function ($pageName, $resource, $themable) {
      return Paladin::getRootFolder() . self::getFile($pageName, $resource, $themable, "resources");
    });
    
    // Creating the addPanel function
    $addPanel = new \Twig_SimpleFunction('addPanel', function ($pageName, $panel, $themable, $args) {
      echo Paladin::getTwig()->render(self::getFile($pageName, $panel, $themable, "panels"), $args);
    });
    
    // Returning an array of the functions
    return array(
      $getResource,
      $addPanel
    );
  }
  
  public function getFile($pageName, $file, $themable, $folder) {
    // Creating the empty resourcePath variable
    $filePath;
    
    // Creating the resource relative path
    $fileRelativePath = "/" . $pageName . "/" . $folder . "/" . $file;
    
    // If the page instance is themable and the current theme contains the resource
    if($themable && file_exists(Paladin::getThemeLoader()->getFolder() . "/" . Paladin::getThemeLoader()->getCurrentTheme() . $fileRelativePath))
      // Setting the template path to the theme template path
      $filePath = Paladin::getThemeLoader()->getFolder() . "/" . Paladin::getThemeLoader()->getCurrentTheme() . $fileRelativePath; 
    else
      // Setting the template path to the default path
      $filePath = Paladin::getPageLoader()->getFolder() . $fileRelativePath;
    
    // Getting the current route
    $route = Paladin::getRouteLoader()->getCurrentRoute();
    
    // Returning the resource path from the root folder
    return $filePath;
  }
  
}

?>