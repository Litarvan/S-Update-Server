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
use Paladin\Http\Response;
use Paladin\Paladin;
use SUpdateServer\SUpdateServer;

/**
 * The install controller, manager the first installation
 *
 * @author  Litarvan
 * @version 3-(Internal-2.1.0-BETA)
 */
class InstallController
{
    public function getInstall()
    {
        return Paladin::view('install.twig', array());
    }

    public function postInstall()
    {
        if (isset($_POST["password"]))
        {
            Paladin::config("server")->set("enabled", false);
            Paladin::config("server")->set("password", sha1($_POST["password"]));
            Paladin::config("stats")->set("connections", 0);
            Paladin::config("stats")->set("ips", []);

            return new RedirectResponse("panel/home");
        }

        return new Response("Argument fail", 500);
    }
}