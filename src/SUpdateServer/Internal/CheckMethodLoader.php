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

namespace SUpdateServer\Internal;

/**
 * The CheckMethodLoader, loads all the check methods !
 *
 * @author TheShark34
 * @package S-Update-Server\Internal
 * @version 3-(Base-2.0.0-BETA)
 */
class CheckMethodLoader {

    /**
     * The current CheckMethodLoader
     */
    private static $checkMethodLoader;

    /**
     * The folder where the check methods are
     */
    private $folder;

    /**
     * The loaded check methods
     */
    private $checkMethods = array();

    /**
     * The default check methods folder
     */
    const DEFAULT_FOLDER = "CheckMethods";

    public function __construct($folder) {
        $this->folder = $folder;
    }

    /**
     * Create the CheckMethodLoader and loads the check methods
     */
    public static function create() {
        self::$checkMethodLoader = new CheckMethodLoader(self::DEFAULT_FOLDER);
        self::$checkMethodLoader->loadCheckMethods();
    }

    /**
     * Loads the check methods
     */
    private function loadCheckMethods() {
        // Getting the files in the check methods folder
        $checkMethods = scandir($this->folder);

        // For each file in the folder
        for($i = 0; $i < count($checkMethods); $i++) {
            // If it is the current/parent folder, or it is .htaccess
            if(trim($checkMethods[$i]) == "." || trim($checkMethods[$i]) == ".." || trim($checkMethods[$i]) == ".htaccess")
                // Continuing the loop
                continue;

            // Getting the check method path
            $checkMethodPath = $this->folder . "/" . $checkMethods[$i];

            // If it is a directory
            if(is_dir($checkMethodPath)) {
                // Continuing the loop
                continue;
            }

            // Loading it
            require $checkMethodPath;

            // Getting the class path
            $classPath = '\\' . substr($checkMethods[$i], 0, strlen($checkMethods[$i]) - 4);

            // Instancing it
            $checkMethod = new $classPath();

            // If it is not an CheckMethod
            if(!($checkMethod instanceof CheckMethod)) {
                // Displaying an message page
                echo "Sorry ! The CheckMethod " . $checkMethods[$i] . " main class is not extending \\SUpdateServer\\AppLoader\\CheckLoader but need to !";

                // Stopping
                die();
            }

            // Adding it to the list
            $this->checkMethods[sizeof($this->checkMethods)] = $checkMethod;
        }
    }

    /**
     * To verify if a check method was loaded
     */
    public function isCheckMethodLoaded($checkMethod) {
        // Replacing the %20 by spaces
        $checkMethod = str_replace("%20", " ", $checkMethod);

        // For each check method
        foreach($this->checkMethods as $cm)
            // If their names are equals
            if($cm->getName() == $checkMethod)
                // Returning true
                return true;

        // If we arrived here, then true wasn't returned so the method
        // wasn't found, so returning false.
        return false;
    }

    /**
     * Gets a check method by its name
     */
    public function getCheckMethod($checkMethod) {
        // Replacing the %20 by spaces
        $checkMethod = str_replace("%20", " ", $checkMethod);

        // For each check method
        foreach($this->checkMethods as $cm) {
            // If their names are equals
            if($cm->getName() == $checkMethod)
                // Returning it
                return $cm;
        }

        // If we arrived here, then true wasn't returned so the method
        // wasn't found, so returning false.
        return false;
    }

    /**
     * Returns the current CheckMethodLoader
     *
     * @return The current CheckMethodLoader
     */
    public static function getCheckMethodLoader() {
        return self::$checkMethodLoader;
    }

}
