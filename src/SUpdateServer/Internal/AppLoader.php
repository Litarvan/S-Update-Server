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
 * The AppLoader, loads all the apps !
 *
 * @author TheShark34
 * @package S-Update-Server\Internal
 * @version 3-(Base-2.0.0-BETA)
 */
class AppLoader {

    /**
     * The current AppLoader
     */
    private static $appLoader;

    /**
     * The folder where the applications are
     */
    private $folder;

    /**
     * The loaded applications
     */
    private $apps = array();

    /**
     * The default apps folder
     */
    const DEFAULT_FOLDER = "Apps";

    public function __construct($folder) {
        $this->folder = $folder;
    }

    /**
     * Create the AppLoader and loads the applications
     */
    public static function create() {
        self::$appLoader = new AppLoader(self::DEFAULT_FOLDER);
        self::$appLoader->loadApps();
    }

    /**
     * Loads the applications
     */
    private function loadApps() {
        // Getting the files in the applications folder
        $apps = scandir($this->folder);

        // For each file in the folder
        for($i = 0; $i < count($apps); $i++) {
            // If it is the current/parent folder
            if(trim($apps[$i]) == "." || trim($apps[$i]) == "..")
                // Continuing the loop
                continue;

            // If it is not a directory
            if(!is_dir($this->folder . "/" . $apps[$i])) {
                // Getting the application class path
                $appMainClassPath = $this->folder . "/" . $apps[$i];

                // Loading it
                require $appMainClassPath;

                // Getting the class name
                $className = basename($this->folder . "/" . $apps[$i], ".php");

                // Instancing it
                $app = new $className;

                // If it is not an Application
                if(!($app instanceof Application)) {
                    // Displaying an error page
                    echo "Sorry ! The Application " . $apps[$i] . " main class is not extending \\SUpdateServer\\AppLoader\\Application but need to !";

                    // Stopping
                    die();
                }
                // Executing the load event
                $app->load();

                // Adding it to the list
                $this->apps[sizeof($this->apps)] = $app;
            }
        }
    }

    /**
     * To verify if an application was loaded
     */
    public function isApplicationLoaded($application) {
        // Replacing the %20 by spaces
        $application = str_replace("%20", " ", $application);

        // For each application
        foreach($this->apps as $app)
            // If their names are equals
            if($app->getName() == $application)
                // Returning true
                return true;

        // If we arrived here, then true wasn't returned so the application
        // wasn't found, so returning false.
        return false;
    }

    /**
     * Returns the current AppLoader
     *
     * @return The current AppLoader
     */
    public static function getAppLoader() {
        return self::$appLoader;
    }

}
