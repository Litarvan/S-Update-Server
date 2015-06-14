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

namespace SUpdateServer\Pages;

/**
 * An error page
 *
 * @author TheShark34
 * @package S-Update-Server\Pages
 * @version 1.0.0-BETA
 */
class Index extends \Paladin\Page {

  public function getName() {
    return "Index";
  }

  public function getMainPage() {
    return "Index.php.twig";
  }

  public function isThemable() {
    return true;
  }

  public function constructTwigArray($args) {
    return array(
      "paladinVersion" => $args["paladinVersion"],
      "twigVersion" => $args["twigVersion"],
      "serverVersion" => $args["serverVersion"]
    );
  }
  
}
