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
 * A simple Page
 *
 * @author TheShark34
 * @package Paladin
 * @version 1.0.0-BETA
 */
class Page {

  /**
   * Returns the name of the page
   *
   * @return The page name
   */
  public function getName() {
  }

  /**
   * Returns the main twig page to be displayed
   *
   * @return The name of the main page
   */
  public function getMainPage() {
  }

  /**
   * Called by the PageLoader before displaying the page
   */
  public function beforeDisplayed() {
  }

  /**
   * Returns if the Page is themable
   */
  public function isThemable() {
  }

  /**
   * Returns the twig arguments array of the page
   *
   * @param $args
   *            The arguments of the page given in the Paladin::loadPage method
   * @return Page twig arguments array
   */
  public function constructTwigArray($args) {
  }

  /**
   * Called by the PageLoader after having displayed the page
   */
  public function afterDisplayed() {
  }

}
