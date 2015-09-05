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

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

// Panel routes

$app->get("/", function() {
    return new RedirectResponse("panel");
});

$app->get("/panel", function() {
    return new RedirectResponse("panel/home");
});

$app->get("/panel/{request}", "panel:getPanel")->before(SUpdateServer::installMiddleware())->before(SUpdateServer::authMiddleware());
$app->post("/panel/{request}", "panel:postPanel")->before(SUpdateServer::installMiddleware())->before(SUpdateServer::authMiddleware());

$app->get("/aubergine", function() {
    return new RedirectResponse("http://www.google.fr/search?q=aubergine");
});

$app->get("/auth/logout", "auth:logout")->before(SUpdateServer::authMiddleware())->before(SUpdateServer::installMiddleware());
$app->get("/auth/login", "auth:getLogin")->before(SUpdateServer::authMiddleware())->before(SUpdateServer::installMiddleware());
$app->post("/auth/login", "auth:postLogin")->before(SUpdateServer::authMiddleware())->before(SUpdateServer::installMiddleware());


// Internal routes

$app->get("/set-enabled/{enabled}", function($enabled) {
    if($enabled == "true")
        SUpdateServer::serverConfig()->set("enabled", true);
    else if($enabled = "false")
        SUpdateServer::serverConfig()->set("enabled", false);
    else
        return new Response("Bad Argument, need to be true or false");

    return new Response("");
})->before(SUpdateServer::installMiddleware())->before(SUpdateServer::authMiddleware());

$app->get("/install", "install:getInstall")->before(SUpdateServer::installMiddleware());
$app->post("/install", "install:postInstall")->before(SUpdateServer::installMiddleware());

$app->post("/server/{request}", "server:postServer");
$app->post("/server/list/{checkmethod}", "server:listFiles");
$app->post("/server/check/{thing}/{what}", "server:check");

$app->post("/stats/clear/{stat}", "stats:clear")->before(SUpdateserver::authMiddleware());
$app->post("/stats/update", "stats:update")->before(SUpdateserver::authMiddleware());
$app->post("/stats/get/{stat}", "stats:get");

?>
