<?php

/* Copyright 2015-2016 Adrien Navratil
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

namespace SUpdateServer\Middlewares;

use Paladin\Http\RedirectResponse;
use Paladin\Http\Response;
use Paladin\Paladin;
use Paladin\Routing\Middleware;

/**
 * The auth middleware, to manage the session
 *
 * @author  Litarvan
 * @version 3-(Internal-2.1.0-BETA)
 */
class AuthMiddleware extends Middleware
{
    public function getName()
    {
        return "auth";
    }

    public function onCalled($route)
    {
        $isLoginPage = trim($route->getPath(), '/') == "auth/login";
        $isUserLogged = isset($_SESSION["logged"]) && $_SESSION["logged"] == true;

        if ($isLoginPage)
            if ($isUserLogged)
                return new RedirectResponse(Paladin::getRootPath(true) . "/panel");
            else
                return false;

        else if ($isUserLogged)
            return false;
        else
            return new RedirectResponse(Paladin::getRootPath(true) . "auth/login");
    }
}