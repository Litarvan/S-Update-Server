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

use \Paladin\Route;

/**
 * The SetStat route, set the value of a stat
 *
 * @author TheShark34
 * @package S-Update-Server\Routes
 * @version 3.0.0-BETA
 */
class SetStat extends Route {

    public function onCalling($args) {
        // Checking the arguments
        if(sizeof($args) == 1)
            if($args[0] == "IPUpdate") {
                // Getting the user ip
                $ip = self::getIp();

                // Updating the ip list
                \SUpdateServer\StatsManager::set("ips", array_merge(\SUpdateServer\StatsManager::get("ips"), array("$ip : " . date('m/d/Y h:i:s a', time()))));

                // Incrementing the connections number
                \SUpdateServer\StatsManager::set("connections", \SUpdateServer\StatsManager::get("connections") + 1);
            } else
                // Clearing the stat
                \SUpdateServer\StatsManager::set($args[0], "");
        else if(sizeof($args) < 1)
            echo "Bad Arguments, needed : key of the stat, then value to set (you can provide just the key but then it will reset the value)";
        else
            // Setting the stat
            \SUpdateServer\StatsManager::set($args[0], $args[1]);

        // Writing the stats
        \SUpdateServer\StatsManager::write();
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
