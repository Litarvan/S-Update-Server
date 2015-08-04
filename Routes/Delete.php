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
 * The Delete Route, to delete a file/folder
 *
 * @author TheShark34
 * @package S-Update-Server\Routes
 * @version 3.0.0-BETA
 */
class Delete extends Route {

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

        // Deleting it
        $this->recursiveDelete($path);
    }

    private function recursiveDelete($toDelete) {
        if(is_dir($toDelete)) {
            if(!$this->isEmpty($toDelete)) {
                $files = scandir($toDelete);
                foreach($files as $file)
                    if($file != "." && $file != "..")
                        $this->recursiveDelete($toDelete . "/" . $file);
            }
            rmdir($toDelete);
        }
        else
            unlink($toDelete);
    }

    private function isEmpty($dir) {
        if (!is_readable($dir))
            return null;

        $handle = opendir($dir);
        while (false !== ($entry = readdir($handle)))
            if ($entry != "." && $entry != "..")
                return false;

        return true;
    }

}

?>
