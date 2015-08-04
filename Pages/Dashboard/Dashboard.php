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

namespace SUpdateServer\Pages;

/**
 * The Dashboard page
 *
 * @author TheShark34
 * @package S-Update-Server\Pages
 * @version 3.0.0-BETA
 */
class Dashboard extends \Paladin\Page {

  public function getName() {
    return "Dashboard";
  }

  public function getMainPage() {
    return "Dashboard.php.twig";
  }

  public function isThemable() {
    return true;
  }

  public function constructTwigArray($args) {
    $entries = array();
    $dashboardEntries = $args[0];

    foreach($dashboardEntries as $dashboardEntry)
        $entries[sizeof($entries)] = array(
            "name" => $dashboardEntry->getName(),
            "icon" => $dashboardEntry->getIcon(),
            "link" => $dashboardEntry->getLink()
        );

    return array(
        "entries" => $entries
    );
  }

}
