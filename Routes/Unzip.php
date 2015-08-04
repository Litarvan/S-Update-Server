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
 * The Unzip Route, to unzip a zip file
 *
 * @author TheShark34
 * @package S-Update-Server\Routes
 * @version 3.0.0-BETA
 */
class Unzip extends Route {

    public function onCalling($args) {
        // Checking the argument
        if(sizeof($args) == 0) {
            echo "Bad Arguments";
            return;
        }

        // Getting the total arguments
        $path = "";
        foreach($args as $arg)
            $path .= ($arg . "/");
        $path = substr($path, 0, strlen($path) - 1);

        // Unzipping it
        $zip = new ZipArchive;
        $res = $zip->open($path);
        if ($res === true) {
            $zip->extractTo(dirname($path));
            $zip->close();
        }
    }

}

?>
