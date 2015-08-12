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
 * The Get Total Size, to get the total size of the given files
 *
 * @author TheShark34
 * @package S-Update-Server\Routes
 * @version 3.0.0-BETA
 */
class GetTotalBytes extends Route {

    public function onCalling($args) {
        // Setting the header
        header("Content-Type: application/json");

        // Creating the variable
        $totalSize = 0;

        // Reading the php input;
        $json = file_get_contents("php://input");

        // Getting the list
        $list = json_decode($json);

        // If JSON failed, printing an error message
        if(json_last_error() !== JSON_ERROR_NONE) {
            echo "Bad Request : '" . $json . "'";
            switch(json_last_error()) {
                case JSON_ERROR_DEPTH:
                    echo ' - Maximum stack depth exceeded';
                    break;
                case JSON_ERROR_CTRL_CHAR:
                    echo ' - Unexpected control character found';
                    break;
                case JSON_ERROR_SYNTAX:
                    echo ' - Syntax error, malformed JSON';
                    break;
                case JSON_ERROR_NONE:
                    echo ' - No errors';
                    break;
            }
            die();
        }

        // For each file
        foreach($list as $file)
            // Adding its size to the total size
            $totalSize += filesize(str_replace("//", "/", "files/" . urldecode($file)));

        // Printing the version in a JSON
        echo json_encode(
            array("totalBytes" =>
                $totalSize),
            JSON_PRETTY_PRINT);
    }

}

?>
