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
 * Print the list of files
 *
 * @author TheShark34
 * @package S-Update-Server\Routes
 * @version 3.0.0-BETA
 */
class ListFiles extends Route {

    const FILES_FOLDER = "files/";

    public function onCalling($args) {
        // Setting the header
        header("Content-Type: application/json");

        // If there is no argument given
        if(sizeof($args) == 0)
            // Stopping
            return;

        // Creating the list
        $list = array();

        // Getting the list of all files in the files folder
        $files = $this->listFolder(self::FILES_FOLDER, array());

        // Getting the selected check method
        $checkMethod = \SUpdateServer\Checking\CheckMethodLoader::getCheckMethodLoader()->getCheckMethod($args[0]);

        // If it returned false (The method wasn't found)
        if(!$checkMethod) {
            // Printing an error message
            echo "Unknown check method. This is normally unpossible so please go away.";

            // And stopping
            return;
        }

        // For each file
        foreach($files as $file) {
            // If it is a directory
            if(is_dir($file))
                // Continuing the loop
                continue;

            // Getting the file infos by the selected check method
            $list[sizeof($list)] = $checkMethod->createFileInfos($file);
        }

        // Finally printing the list
        echo json_encode($list, JSON_PRETTY_PRINT);
    }

    private function listFolder($folder, $list) {
        // Getting the list of all files in the folder
        $files = glob($folder . "/*");

        // For each file
        foreach($files as $file)
            // If it is a directory
            if(is_dir($file))
                // Listing it
                $list = $this->listFolder($file, $list);

            // Else
            else
                // Adding it to the list
                $list[sizeof($list)] = str_replace("\\", "/", substr($file, 6));

        // Returning the list
        return $list;
    }

}
