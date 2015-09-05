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

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * The install controller to manage the installation
 *
 * @package \SUpdateServer
 * @version 3-(Base-2.0.0-BETA)
 */
class InstallController {

    public function getInstall() {
        return SUpdateServer::app()->display('install.twig', array());
    }

    public function postInstall() {
        if(isset($_POST["password"])) {
            SUpdateServer::serverConfig()->set("enabled", true);
            SUpdateServer::serverConfig()->set("password", sha1($_POST["password"]));
            SUpdateServer::serverConfig()->set("connections", "0");
            SUpdateServer::serverConfig()->set("ips", "");

            return new RedirectResponse("panel/home");
        }

        return new Response("Argument fail", 500);
    }

}

?>
