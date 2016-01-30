<?php

/*
 * Copyright 2015-2016 Adrien Navratil
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

namespace SUpdateServer\Controllers;

use Paladin\Http\JsonResponse;
use Paladin\Http\Response;
use Paladin\Paladin;
use SUpdateServer\Application\AppLoader;
use SUpdateServer\CheckMethod\CheckMethodLoader;
use SUpdateServer\SUpdateServer;

/**
 * The server controller, to do some internal things
 *
 * @author  Litarvan
 * @version 3-(Internal-2.1.0-BETA)
 */
class ServerController
{
    public function postServer($request)
    {
        header("Content-Type: application/json");

        switch ($request)
        {
            case "is-enabled":
                return new JsonResponse(array("enabled" => (bool) Paladin::config("server")->get("enabled")));
            case "size":
                return $this->size();
            case "version":
                return new JsonResponse(array("version" => SUpdateServer::SERVER_VERSION));
        }

        return new Response("Unknown request");
    }

    private function size()
    {
        // Creating the variable
        $totalSize = 0;

        // Reading the php input;
        $json = file_get_contents("php://input");

        // Getting the list
        $list = json_decode($json);

        // If JSON failed, printing an error message
        if (json_last_error() !== JSON_ERROR_NONE)
        {
            echo "Bad Request : '" . $json . "'";
            switch (json_last_error())
            {
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
        foreach ($list as $file)
            // Adding its size to the total size
            $totalSize += filesize(SUpdateServer::FILES_DIRECTORY . "/" . urldecode($file));

        return new JsonResponse(array("size" => $totalSize));
    }

    public function listFiles($checkmethod)
    {
        // Creating the list
        $list = array();

        // Getting the list of all files in the files folder
        $files = $this->listFolder(SUpdateServer::FILES_DIRECTORY, array());

        // Getting the selected check method
        $checkMethod = CheckMethodLoader::getCheckMethodLoader()->getCheckMethod($checkmethod);

        // If it returned false (The method wasn't found)
        if (!$checkMethod)
            // Printing an error message
            return "Unknown check method. This is normally impossible so please go away.";

        // For each file
        foreach ($files as $file)
        {
            // If it is a directory
            if (is_dir($file))
                // Continuing the loop
                continue;

            // Getting the file infos by the selected check method
            $list[sizeof($list)] = $checkMethod->createFileInfos($file);
        }

        return new JsonResponse($list);
    }

    private function listFolder($folder, $list)
    {
        // Getting the list of all files in the folder
        $files = glob($folder . "/*");

        // For each file
        foreach ($files as $file)
            // If it is a directory
            if (is_dir($file))
                // Listing it
                $list = $this->listFolder($file, $list);

            // Else
            else
                // Adding it to the list
                $list[sizeof($list)] = str_replace("\\", "/", substr($file, 6));

        // Returning the list
        return $list;
    }

    public function check($thing, $what)
    {
        if ($thing == "checkmethod")
            $present = CheckMethodLoader::getCheckMethodLoader()->isCheckMethodLoaded($what);
        else if ($thing == "application")
        {
            $present = AppLoader::getAppLoader()->isApplicationLoaded($what);
        }
        else
            return new Response(200, "First argument need to be checkmethod, or application");

        return new JsonResponse(array("present" => $present));
    }
}
