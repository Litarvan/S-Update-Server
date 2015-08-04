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

namespace SUpdateServer;

/**
 * The StatsManager, manage all the differents statistics
 *
 * @author TheShark34
 * @package S-Update-Server
 * @version 3.0.0-BETA
 */
class StatsManager {

    /**
     * All the different stats
     */
    private static $stats = array();

    /**
     * The location of the stats directory
     */
    const STATS_DIR = "S-Update-Server/Stats/";

    /**
     * The number of connections
     */
    const CONNECTIONS_NUMBER_LOCATION = "S-Update-Server/Stats/connections.number";

    /**
     * The location of the ip list
     */
    const IP_LIST_LOCATION = "S-Update-Server/Stats/IPs.list";

    /**
     * Load the different stats
     */
    public static function loadStats() {
        // Creating the stats dir if it doesn't exist
        if(!file_exists(self::STATS_DIR))
            mkdir(self::STATS_DIR);

        // Loading the number of connections
        if(!file_exists(self::CONNECTIONS_NUMBER_LOCATION)) {
            touch(self::CONNECTIONS_NUMBER_LOCATION);
            self::set("connections", 0);
        } else
            self::set("connections", file_get_contents(self::CONNECTIONS_NUMBER_LOCATION));

        // Loading the last ips list
        if(!file_exists(self::IP_LIST_LOCATION)) {
            touch(self::IP_LIST_LOCATION);
            self::set("ips", "");
        } else
            self::set("ips", explode("|", file_get_contents(self::IP_LIST_LOCATION)));
    }

    /**
     * Set a stat value
     *
     * @param key
     *            The name of the stat
     * @param value
     *            The new stat value
     */
    public static function set($key, $value) {
        self::$stats[$key] = $value;
    }

    /**
     * Return a stat value
     *
     * @param key
     *            The name of the stat to get the value
     *
     * @return The given stat value
     */
    public static function get($key) {
        return self::$stats[$key];
    }

    /**
     * Return the list of all the stats
     *
     * @return The stats list
     */
    public static function getStats() {
        return self::$stats;
    }

    /**
     * Write the stats (not all the array, only the S-Update stats)
     */
    public static function write() {
        // Writing the connections number
        file_put_contents(self::CONNECTIONS_NUMBER_LOCATION, self::get("connections"));

        // If there are no ip, clearing the ip list, then stopping
        if(self::get("ips") == "") {
            file_put_contents(self::IP_LIST_LOCATION, "");
            return;
        }

        // Merging all the ips array content with a | at the end to explode it then
        $ipList = "";
        foreach(self::get("ips") as $ip)
            if($ip != "")
                $ipList .= ($ip . "|");

        // Writing the ip list
        file_put_contents(self::IP_LIST_LOCATION, $ipList);
    }

}

?>
