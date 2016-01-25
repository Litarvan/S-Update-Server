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

use Paladin\Http\RedirectResponse;
use Paladin\Http\Response;
use Paladin\Paladin;
use SUpdateServer\SUpdateServer;

$this->get("/", function ()
{
    return new RedirectResponse(Paladin::getRootPath(true) . "panel");
});

$this->get("/panel", function ()
{
    return new RedirectResponse(Paladin::getRootPath(true) . "panel/home");
});

$this->get("/panel/:request", ["middleware" => ["install", "auth"], "uses" => "PanelController@getPanel"]);
$this->post("/panel/:request", ["middleware" => ["install", "auth"], "uses" => "PanelController@postPanel"]);

$this->get("/aubergine", function ()
{
    return new RedirectResponse("http://www.google.fr/search?q=aubergine");
});

$this->get("/auth/logout", ["middleware" => ["install", "auth"], "uses" => "AuthController@logout"]);
$this->get("/auth/login", ["middleware" => ["install", "auth"], "uses" => "AuthController@getLogin"]);
$this->post("/auth/login", ["middleware" => ["install"], "uses" => "AuthController@postLogin"]);


// Internal routes

$this->get("/set-enabled/:enabled", ["middleware" => ["install", "auth"], "uses" => function($enabled)
{
    Paladin::config("server")->set("enabled", $enabled == "true");

    return new Response();
}]);

$this->get("/install", ["middleware" => "install", "uses" => "InstallController@getInstall"]);
$this->post("/install", ["middleware" => "install", "uses" => "InstallController@postInstall"]);

$this->post("/server/:request", "ServerController@postServer");
$this->post("/server/list/:checkmethod", "ServerController@listFiles");
$this->post("/server/check/:thing/:what", "ServerController@check");

$this->post("/stats/clear/:stat", ["middleware" => "auth", "uses" => "StatsController@clear"]);
$this->post("/stats/update", ["middleware" => "auth", "uses" => "StatsController@update"]);
$this->post("/stats/get/:stat", "StatsController@get");