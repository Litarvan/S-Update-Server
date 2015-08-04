
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
 * The Settings Route, displays the Settings page.
 *
 * @author TheShark34
 * @package S-Update-Server\Routes
 * @version 3.0.0-BETA
 */
class Settings extends Route {

    public function onCalling($args) {
        // If the request method is POST
        if($_SERVER['REQUEST_METHOD'] == "POST")
            // Checking the form response
            $this->checkFormResponse();
        // Else
        else
            // Displaying the settings page
            \Paladin\Paladin::getPageLoader()->displayPage("\\SUpdateServer\\Pages", "Settings", array());
    }

    public function checkFormResponse() {
        // If the form variable exist
        if(isset($_POST["form"])) {
            // If the form is the password form
            if($_POST["form"] == "passwordForm") {
                    // If the password variable exist
                    if(isset($_POST["password"])) {
                        // Writing it
                        file_put_contents(\SUpdateServer\SessionManager::getSessionManager()->getPasswordLocation(), sha1($_POST["password"]));

                        // Then redirecting the user
                        header("Location: Index");
                    }
                    // Else
                    else
                        // Displaying the settings page
                        \Paladin\Paladin::getPageLoader()->displayPage("\\SUpdateServer\\Pages", "Settings", array());
            }
            // Else if it is the language form
            else if($_POST["form"] == "langForm") {
                // If the language variable exist
                if(isset($_POST["language"])) {
                    // Setting it
                    \SUpdateServer\LangLoader\LangLoader::getLangLoader()->setCurrentLang($_POST["language"]);
                    
                    // Then redirecting the user
                    header("Location: Index");
                }
                // Else
                else
                    // Displaying the settings page
                    \Paladin\Paladin::getPageLoader()->displayPage("\\SUpdateServer\\Pages", "Settings", array());
            }
            // Else
            else
                // Displaying the settings page
                \Paladin\Paladin::getPageLoader()->displayPage("\\SUpdateServer\\Pages", "Settings", array());
        }
        // Else
        else
            // Displaying the settings page
            \Paladin\Paladin::getPageLoader()->displayPage("\\SUpdateServer\\Pages", "Settings", array());
    }

}

?>
