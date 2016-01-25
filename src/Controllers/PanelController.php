<?php

/*
 * Copyright 2015-2016 Adrien Navratil
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

namespace SUpdateServer\Controllers;

use Paladin\Http\RedirectResponse;
use Paladin\Paladin;
use SUpdateServer\SUpdateServer;

/**
 * The panel controller to display the panel things
 *
 * @author  Litarvan
 * @version 3-(Internal-2.1.0-BETA)
 */
class PanelController
{
    public function getPanel($request)
    {
        if($request == "home")
            return Paladin::view("home.twig", array(
                "paladinVersion" => Paladin::VERSION,
                "server" => SUpdateServer::SERVER_VERSION,
                "base" => SUpdateServer::BASE_VERSION,
                "panel" => SUpdateServer::PANEL_VERSION,
                "internal" => SUpdateServer::INTERNAL_VERSION,
                "serverEnabled" => Paladin::config("server")->get("enabled")
            ));
        else if($request == "about")
            return Paladin::view("about.twig");
        else if($request == "settings")
            return Paladin::view("settings.twig");
        else if ($request == "statistics")
            return Paladin::view("stats.twig", array(
                "connections" => Paladin::config("stats")->get("connections"),
                "ips" => (array) Paladin::config("stats")->get("ips")
            ));
        else
            return new RedirectResponse("home");
    }

    public function postPanel($request)
    {
        if ($request == "settings")
            if (isset($_POST["password"]))
            {
                Paladin::config("server")->set("password", sha1($_POST["password"]));

                return new RedirectResponse("home");
            }

        return new RedirectResponse("home");
    }
}