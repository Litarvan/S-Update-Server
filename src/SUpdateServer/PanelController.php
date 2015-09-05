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

use Symfony\Component\HttpFoundation\RedirectResponse;

 /**
  * The panel controller to display the panel things
  *
  * @package \SUpdateServer
  * @version 3-(Base-2.0.0-BETA)
  */
class PanelController {

    public function getPanel($request) {
        if($request == "home")
            return SUpdateServer::app()->display("home.twig", array(
                "silexVersion" => SUpdateServer::VERSION,
                "server" => SUpdateServer::SERVER_VERSION,
                "base" => SUpdateServer::BASE_VERSION,
                "panel" => SUpdateServer::PANEL_VERSION,
                "internal" => SUpdateServer::INTERNAL_VERSION,
                "serverEnabled" => SUpdateServer::serverConfig()->get("enabled")
            ));
        else if($request == "about")
            return SUpdateServer::app()->display("about.twig");
        else if($request == "settings")
            return SUpdateServer::app()->display("settings.twig");
        else if ($request == "statistics")
            return SUpdateServer::app()->display("stats.twig", array(
                "connections" => SUpdateServer::serverConfig()->get("connections"),
                "ips" => (array) SUpdateServer::serverConfig()->get("ips")
            ));
        else
            return new RedirectResponse("home");
    }

    public function postPanel($request) {
        if($request == "settings")
            if(isset($_POST["password"])) {
                SUpdateServer::serverConfig()->set("password", sha1($_POST["password"]));
                return new RedirectResponse("home");
            }
    }

}