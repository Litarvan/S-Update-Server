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
use Paladin\Http\JsonResponse;
use Paladin\Paladin;
use SUpdateServer\Application\Application;

/**
 * The FileDeleter
 *
 * <p>
 *     This is application deletes all files not on the server
 *     excepted the ones in the ignore list on the server.
 *     Kinda bulldozer.
 * </p>
 *
 * <p>
 *   _[TT]_j__,(  <br />
 *  (_)oooo(_)'
 * </p>
 *
 * @version 3-(Internal-2.1.0-BETA)
 * @author  Litarvan
 */
class FileDeleter extends Application
{
    /**
     * The list of files to ignore for the FileDeleter
     */
    const IGNORE_LIST_FILES = "config/ignore.list";

    public function getName()
    {
        return "FileDeleter";
    }

    public function load()
    {
        Paladin::getRouter()->get("/get-ignore-list", function ()
        {
            // Creating the ignore list
            $ignoreList = array();

            // Reading the ignore list
            $file = fopen(self::IGNORE_LIST_FILES, "a+");

            while (($line = fgets($file)) !== false)
                $ignoreList[sizeof($ignoreList)] = trim($line);

            fclose($file);

            return new JsonResponse($ignoreList);
        });
    }
}