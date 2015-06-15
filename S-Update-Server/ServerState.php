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
 * The ServerState class, containing the server state (enabled / disabled),
 * and things to save / load it.
 *
 * @author TheShark34
 * @package S-Update-Server
 * @version 1.0.0-BETA
 */
class ServerState {

    /**
     * The current server state
     */
    private static $serverState;

    /**
     * The file where the server state is saved
     */
    const SERVER_STATE_FILE = "S-Update-Server/server.state";

    /**
     * Returns true if the server is enabled, false if not
     *
     * @return If the server is enabled
     */
    public static function isEnabled() {
        // If the server state variable wasn't defined
        if(!self::$serverState)
            // Reading the server state
            self::$serverState = self::readServerState();

        // If the server state is "enabled"
        if(trim(self::$serverState) == "enabled")
            // Returning true
            return true;

        // Retruning false (if true was returned, this code can't execute)
        return false;
    }

    /**
     * Reads the server state
     *
     * @return The server state
     */
    private static function readServerState() {
        if(!file_exists(self::SERVER_STATE_FILE)) {
            file_put_contents(self::SERVER_STATE_FILE, "disabled");
            return "disabled";
        } else
            return file_get_contents(self::SERVER_STATE_FILE);
    }

    /**
     * Sets the server state
     *
     * @param serverState
     *            The new server state
     */
    public static function setServerState($serverState) {
        self::$serverState = $serverState;
        file_put_contents(self::SERVER_STATE_FILE, $serverState);
    }

}
