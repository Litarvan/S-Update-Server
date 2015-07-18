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

/**
 * The Index route
 *
 * @author TheShark34
 * @package S-Update-Server\Routes
 * @version 3.0.0-BETA
 */
class Index extends \Paladin\Route {

    public function onCalling($args) {
        // Getting the Paladin version
        $paladinVersion = file_get_contents("paladin.version");

        // Getting the Twig version
        $twigVersion = "1.18";

        // Getting the S-Update-Server version
        $serverVersion = file_get_contents("s-update-server.version");

        // Getting the server state
        $serverEnabled = \SUpdateServer\ServerState::isEnabled();

        // Displaying the index page
        \Paladin\Paladin::getPageLoader()->displayPage("\\SUpdateServer\\Pages", "Index", array(
                "paladinVersion" => $paladinVersion,
                "serverVersion" => $serverVersion,
                "serverEnabled" => $serverEnabled
            ));
    }

}

?>
