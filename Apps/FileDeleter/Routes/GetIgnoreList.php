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
 * The GetIgnoreList Route, returns the list of the
 * files ignored by the file deleter. These files are
 * wrote in the ignore list file.
 *
 * @author TheShark34
 * @package S-Update-Server\FileDeleter\Routes
 * @version 3.0.0-BETA
 */
class GetIgnoreList extends Route {

    /**
     * The list of files to ignore for the FileDeleter
     */
    const IGNORE_LIST_FILES = "S-Update-Server/Ignore.list";

    public function onCalling($args) {
        // Creating the ignore list
        $ignoreList = array();

        // Reading the ignore list
        $file = fopen(self::IGNORE_LIST_FILES, "a+");

        while (($line = fgets($file)) !== false)
            $ignoreList[sizeof($ignoreList)] = substr($line, 0, strlen($line) - 1);

        fclose($file);

        // Printing the JSON encoded array
        echo json_encode($ignoreList, JSON_PRETTY_PRINT);
    }

}

?>
