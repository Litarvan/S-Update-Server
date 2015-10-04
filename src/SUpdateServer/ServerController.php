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
use Symfony\Component\HttpFoundation\JsonResponse;

class ServerController {

    public function postServer($request) {
        switch($request) {
            case "is-enabled":
                return $this->send(array("enabled" => (bool) SUpdateServer::serverConfig()->get("enabled")));
            case "size":
                return $this->size();
            case "version":
                return $this->send(array("version" => SUpdateServer::SERVER_VERSION));
        }

        return new Response("Unknown request");
    }

    private function send($array) {
        $response = new JsonResponse($array);
        $response->setEncodingOptions(JSON_PRETTY_PRINT);
        return $response;
    }

    private function size() {
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
            $totalSize += filesize(SUpdateServer::FILES_DIRECTORY . "/" . $file);

        return $this->send(array("size" => $totalSize));
    }

    public function listFiles($checkmethod) {
        // Creating the list
        $list = array();

        // Getting the list of all files in the files folder
        $files = $this->listFolder(SUpdateServer::FILES_DIRECTORY, array());

        // Getting the selected check method
        $checkMethod = \SUpdateServer\Internal\CheckMethodLoader::getCheckMethodLoader()->getCheckMethod($checkmethod);

        // If it returned false (The method wasn't found)
        if(!$checkMethod)
            // Printing an error message
            return "Unknown check method. This is normally unpossible so please go away.";

        // For each file
        foreach($files as $file) {
            // If it is a directory
            if(is_dir($file))
                // Continuing the loop
                continue;

            // Getting the file infos by the selected check method
            $list[sizeof($list)] = $checkMethod->createFileInfos($file);
        }

        return $this->send($list);
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

    public function check($thing, $what) {
        if($thing == "checkmethod")
            $present = \SUpdateServer\Internal\CheckMethodLoader::getCheckMethodLoader()->isCheckMethodLoaded($what);
        else if ($thing == "application") {
            $present = \SUpdateServer\Internal\AppLoader::getAppLoader()->isApplicationLoaded($what);
        } else
            return new Response("First argument need to be checkmethod, or application", 500);

        return $this->send(array("present" => $present));
    }

}

?>
