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

namespace SUpdateServer\Dashboard;

/**
 * The DashboardManager, manage the entires of the Dashboard page
 *
 * @author TheShark34
 * @package S-Update-Server\Dashboard
 * @version 3.0.0-BETA
 */
class DashboardManager {

    /**
     * The Dashboard entries
     */
    private static $entries = array();

    /**
     * This method add the S-Update-Server entries
     * Only index.php need to do that
     */
    public static function addSUEntries() {
        self::addEntry(new FileExplorerDBEntry());
        self::addEntry(new StatsDBEntry());
    }

    /**
     * Add an entry to the Dashboard
     *
     * @param entry
     *            The entry to add (need to be a DashboardEntry instance)
     */
    public static function addEntry($entry) {
        // Checking the given entry
        if(!$entry)
            throw new \InvalidArgumentException("Given entry is null");
        if(!($entry instanceof DashboardEntry))
            throw new \InvalidArgumentException("Given entry is not a DashboardEntry instance");

        // Then adding it
        self::$entries[sizeof(self::$entries)] = $entry;
    }

    /**
     * Return an array of all the dashboard entries
     *
     * @return The dashboard entries
     */
    public static function getEntries() {
        return self::$entries;
    }

}

?>
