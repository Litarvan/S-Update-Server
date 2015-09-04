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

/**
 * The stats controller, to manage the stats
 *
 * @package \SUpdateServer
 * @version 3-(Base-2.0.0-BETA)
 */
class StatsController {

    public function clear($stat) {
        if($stat != "connections" && $stat != "ips")
            return new Response("Bad Arguments");

        SUpdateServer::serverConfig()->set($stat, "");
        return new Response();
    }

    public function update() {
        $ips = (array) SUpdateServer::serverConfig()->get("ips");
        $connections = (int) SUpdateServer::serverConfig()->get("connections") + 1;

        $ips[sizeof($ips)] = self::getIp();

        SUpdateServer::serverConfig()->set("ips", $ips);
        SUpdateServer::serverConfig()->set("connections", $connections);

        return new Response();
    }

    public function get($stat) {
        if($stat != "connections" && $stat != "ips")
            return new Response("Bad Arguments");

        return SUpdateServer::serverConfig()->get($stat);
    }

    public static function getIp() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else
            $ip = $_SERVER['REMOTE_ADDR'];

        if($ip == "::1")
            $ip = "127.0.0.1";

        return $ip;
    }

}

?>
