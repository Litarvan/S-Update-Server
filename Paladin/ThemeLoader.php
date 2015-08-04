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
 * The Theme loader
 *
 * @author TheShark34
 * @package Paladin
 * @version 1.0.0-BETA
 */
class ThemeLoader {

  /**
   * The folder containing the pages
   */
  private $folder;

  /**
   * An array of all themes
   */
  private $themes;

  /**
   * The current theme
   */
  private $currentTheme;

  /**
   * Inits the PageLoader with a folder, containing the pages
   */
  public function __construct($folder) {
    $this->folder = $folder;
  }

  /**
   * Loads all themes in the folder
   */
  public function loadThemes() {
    // Getting the list of files in the theme folder
    $folderList = scandir($this->folder);
    
    // For each file
    for ($i = 0; $i < sizeof($folderList); $i++)
      // If it is a folder, and isn't the current/parent folder
      if(is_dir($folderList[$i]) && $folderList[$i] != "." && $folderList[$i] != "..")
        // Adding it to the theme list
        $this->themes[$i] = $folderList[$i];
  }

  /**
   * Returns the current theme folder
   *
   * @return The current folder
   */
  public function getFolder() {
    return $this->folder;
  }

  /**
   * Returns the list of all themes
   *
   * @return The list of themes
   */
  public function getThemes() {
    return $this->themes;
  }

  /**
   * Sets a new theme
   *
   * @param $theme
   *            The new theme to set
   */
  public function setCurrentTheme($theme) {
    $this->currentTheme = $theme;
  }

  /**
   * Returns the current theme
   *
   * @return The current theme
   */
  public function getCurrentTheme() {
    return $this->currentTheme;
  }

}
