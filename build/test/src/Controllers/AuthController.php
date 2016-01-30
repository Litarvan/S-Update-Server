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

use Paladin\Http\RedirectResponse;
use Paladin\Paladin;

/**
 * The auth controller to manage login/logout
 *
 * @author  Litarvan
 * @version 3-(Internal-2.1.0-BETA)
 */
class AuthController
{
    public function logout()
    {
        $_SESSION["logged"] = false;

        return new RedirectResponse("login");
    }

    public function getLogin()
    {
        return Paladin::view("login.twig", array("error" => false, "serverActivated" => Paladin::config("server")->get("enabled")));
    }

    public function postLogin()
    {
        if (isset($_POST["password"]) && sha1($_POST["password"]) == Paladin::config("server")->get("password"))
        {
            $_SESSION["logged"] = true;

            return new RedirectResponse("../panel/home");
        }
        else
            return Paladin::view("login.twig", array("error" => true, "serverActivated" => Paladin::config("server")->get("enabled")));
    }
}
