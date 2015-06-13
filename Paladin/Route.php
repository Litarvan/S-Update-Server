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
 * A simple URL route
 *
 * @author TheShark34
 * @package Paladin
 * @version 1.0.0-BETA
 */
abstract class Route {

  /**
   * Called when the route is called
   *
   * @param $args
   *            The arguments of the route, every things (excepted the route name and the website url) of the url separated by /
   *            By exemple for this url : http://foo.bar/this/is/a/url The route name would be this, and the arguments 'is', 'a', and 'url'
   */
  protected abstract function onCalling($args);

}
?>
