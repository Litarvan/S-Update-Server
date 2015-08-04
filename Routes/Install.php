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
 * The Install Route, displays the Login page.
 *
 * @author TheShark34
 * @package S-Update-Server\Routes
 * @version 3.0.0-BETA
 */
class Install extends Route {

    public function onCalling($args) {
        // If the password file exist
        if(file_exists(\SUpdateServer\SessionManager::getSessionManager()->getPasswordLocation()))
            // Redirecting the user to the index page
            header("Location: Index");

        // If the request method is POST
        if($_SERVER['REQUEST_METHOD'] == "POST")
            // Checking the form response
            $this->checkFormResponse();
        // Else
        else
            // Displaying the install page
            \Paladin\Paladin::getPageLoader()->displayPage("\\SUpdateServer\\Pages", "Install", array());
    }

    private function checkFormResponse() {
        // If the password/laguage aren't given
        if(!isset($_POST["password"]) || !isset($_POST["language"]))
            // Displaying the install page
            \Paladin\Paladin::getPageLoader()->displayPage("\\SUpdateServer\\Pages", "Install", array());
        // Else
        else {
            // Seting the user logged
            $_SESSION["logged"] = true;

            // Saving the config
            file_put_contents(\SUpdateServer\SessionManager::getSessionManager()->getPasswordLocation(), sha1($_POST["password"]));
            \SUpdateServer\LangLoader\LangLoader::getLangLoader()->setCurrentLang($_POST["language"]);

            // Redirecting the user
            header("Location: " . \Paladin\Paladin::getRootFolder());
        }
    }

}

?>
