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
 * The File Explorer, displays the File Explorer page.
 *
 * @author TheShark34
 * @package S-Update-Server\Routes
 * @version 3.0.0-BETA
 */
class FileExplorer extends Route {

    public function onCalling($args) {
        // Getting the super folder while it ends with ..
        while(isset($args[sizeof($args)]) && $args[sizeof($args)] == "..") {
            unset($args[sizeof($args) - 1]);
            unset($args[sizeof($args) - 1]);

            // Then redirecting
            $redirect = true;
        }

        // Getting the path to explore
        $path = "";

        if(sizeof($args) > 0)
            foreach($args as $f)
                $path .= ($f . "/");
        else {
            $path = "files/";
            $redirect = true;
        }

        // Replacing the //
        $path = str_replace("//", "/", $path);

        // Deleting the last /
        $path = substr($path, 0, strlen($path) - 1);

        // Redirecting if needed
        if(isset($redirect) && $redirect) {
            header("Location: " . \Paladin\Paladin::getRootFolder() . "FileExplorer/" . $path);
            return;
        }

        // If it doesn't exist redirecting the the main explorer
        if(!file_exists($path)) {
            header("Location: " . \Paladin\Paladin::getRootFolder() . "FileExplorer");
            return;
        }

        // If it is not a directory
        if(!is_dir($path)) {
            header("Content-Type: application/force-download; name=\"" . basename($path) . "\"");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . filesize($path));
            header("Content-Disposition: attachment; filename=\"" . basename($path) . "\"");
            header("Expires: 0");
            header("Cache-Control: no-cache, must-revalidate");
            header("Pragma: no-cache");
            readfile($path);

            return;
        }

        // Then displaying the page
        \Paladin\Paladin::getPageLoader()->displayPage("\\SUpdateServer\\Pages", "FileExplorer", array(
            "path" => $path,
            "files" => self::scan($path),
            "root" => \Paladin\Paladin::getRootFolder()
        ));
    }

    private function scan($path) {
        $fs = scandir($path);
        $files = array();
        $folders = array();

        foreach($fs as $file)
            if(!$fs || $file == '.')
                continue;
            else if(is_dir($path . "/" . $file))
                $folders[sizeof($folders)] = $path . "/" . $file;
            else
                $files[sizeof($files)] = $path . "/" . $file;

        return array_merge($folders, $files);
    }

}

?>
